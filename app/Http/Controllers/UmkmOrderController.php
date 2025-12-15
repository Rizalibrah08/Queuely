<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->isUmkm()) {
            return redirect()->route('profile.index')->with('error', 'Unauthorized access.');
        }

        $umkm = $user->umkm;

        // Get orders for this UMKM, ordered by latest
        $orders = Order::where('umkm_id', $umkm->id)
            ->with(['user', 'items.menu'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Separate orders by status if needed, or send all to view
        $activeOrders = $orders->whereIn('status', ['pending', 'processing']);
        $completedOrders = $orders->where('status', 'completed');
        $cancelledOrders = $orders->where('status', 'cancelled');

        return view('backend.umkm.orders.index', compact('activeOrders', 'completedOrders', 'cancelledOrders', 'orders'));
    }

    public function history()
    {
        $user = Auth::user();

        if (!$user->isUmkm()) {
            return redirect()->route('profile.index')->with('error', 'Unauthorized access.');
        }

        $umkm = $user->umkm;

        // Get completed and cancelled orders
        $orders = Order::where('umkm_id', $umkm->id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->with(['user', 'items.menu'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.umkm.orders.history', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->umkm_id !== Auth::user()->umkm->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
