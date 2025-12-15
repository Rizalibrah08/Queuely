<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $input = $request->all();
        $umkm_id = $input['umkm_id'];
        $items = $input['items'] ?? [];

        $umkm = \App\Models\UMKM::findOrFail($umkm_id);
        $orderItems = [];
        $totalAmount = 0;

        foreach ($items as $menuId => $qty) {
            if ($qty > 0) {
                $menu = \App\Models\Menu::find($menuId);
                if ($menu) {
                    $subtotal = $menu->price * $qty;
                    $orderItems[] = [
                        'menu' => $menu,
                        'quantity' => $qty,
                        'subtotal' => $subtotal
                    ];
                    $totalAmount += $subtotal;
                }
            }
        }

        if (empty($orderItems)) {
            return back()->with('error', 'Pilih minimal 1 item.');
        }

        return view('backend.orders.checkout', compact('umkm', 'orderItems', 'totalAmount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'umkm_id' => 'required',
            'payment_method' => 'required'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // 1. Generate Queue Number (Simple Logic: Count today's orders for this UMKM + 1)
            $todayOrders = Order::where('umkm_id', $request->umkm_id)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->count();

            $queueNumber = 'A-' . str_pad($todayOrders + 1, 3, '0', STR_PAD_LEFT);

            // 2. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'umkm_id' => $request->umkm_id,
                'queue_number' => $queueNumber,
                'total_amount' => $request->total_amount,
                'status' => 'pending', // Masuk antrian
                'payment_status' => 'paid', // Simulasi langsung lunas
                'payment_method' => $request->payment_method
            ]);

            // 3. Save Items
            $itemsData = json_decode($request->items, true);
            foreach ($itemsData as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'], // Assuming ID is passed
                    'menu_name' => $item['name'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price']
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('orders.success', $order->id);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('umkm')->findOrFail($id);

        // Calculate estimated wait time (Simple logic: 5 mins per person ahead)
        // Count active orders before this one
        $peopleAhead = Order::where('umkm_id', $order->umkm_id)
            ->where('status', 'pending')
            ->where('id', '<', $order->id)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->count();

        $estimatedWait = ($peopleAhead + 1) * 5; // +1 includes self processing time or 5 mins base

        return view('backend.orders.success', compact('order', 'peopleAhead', 'estimatedWait'));
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            // Guest mode: empty collections
            $activeOrders = collect([]);
            $completedOrders = collect([]);
            $allOrders = collect([]);
            return view('backend.orders.index', compact('activeOrders', 'completedOrders', 'allOrders'));
        }

        // Get orders for this user, ordered by latest
        $orders = Order::where('user_id', $user->id)
            ->with(['umkm', 'items.menu'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Separate orders by status if needed
        $activeOrders = $orders->whereIn('status', ['pending', 'processing']);
        $completedOrders = $orders->where('status', 'completed');
        $allOrders = $orders;

        // Calculate Queue Stats for the top active order (if any)
        $queueStats = null;
        $firstActive = $activeOrders->first();

        if ($firstActive) {
            $peopleAhead = Order::where('umkm_id', $firstActive->umkm_id)
                ->whereIn('status', ['pending', 'processing'])
                ->where('id', '<', $firstActive->id)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->count();

            $currentOrder = Order::where('umkm_id', $firstActive->umkm_id)
                ->where('status', 'processing')
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->oldest()
                ->first();

            // Fallback if no one processing
            if (!$currentOrder) {
                $nextOrder = Order::where('umkm_id', $firstActive->umkm_id)
                    ->where('status', 'pending')
                    ->whereDate('created_at', \Carbon\Carbon::today())
                    ->oldest()
                    ->first();
                $servingQueue = $nextOrder ? $nextOrder->queue_number : 'Waiting';
            } else {
                $servingQueue = $currentOrder->queue_number;
            }

            $queueStats = [
                'peopleAhead' => $peopleAhead,
                'servingQueue' => $servingQueue,
                'estimatedWait' => ($peopleAhead + 1) * 5
            ];
        }

        return view('backend.orders.index', compact('activeOrders', 'completedOrders', 'allOrders', 'queueStats'));
    }
}
