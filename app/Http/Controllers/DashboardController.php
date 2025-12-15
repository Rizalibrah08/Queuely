<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // 1. Get Active Queue (if logged in)
        // 1. Get Active Queue (if logged in)
        $activeQueue = null;
        $peopleAhead = 0;
        $servingQueue = '-';

        if ($user) {
            $activeQueue = \App\Models\Order::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'processing'])
                ->with('umkm')
                ->latest()
                ->first();

            if ($activeQueue) {
                // Count people ahead
                $peopleAhead = \App\Models\Order::where('umkm_id', $activeQueue->umkm_id)
                    ->whereIn('status', ['pending', 'processing'])
                    ->where('id', '<', $activeQueue->id)
                    ->whereDate('created_at', \Carbon\Carbon::today())
                    ->count();

                // Get currently serving queue
                $currentOrder = \App\Models\Order::where('umkm_id', $activeQueue->umkm_id)
                    ->where('status', 'processing')
                    ->whereDate('created_at', \Carbon\Carbon::today())
                    ->oldest()
                    ->first();

                $servingQueue = $currentOrder ? $currentOrder->queue_number : 'Waiting';

                // If no one is processing, the first pending is "next"
                if (!$currentOrder) {
                    $nextOrder = \App\Models\Order::where('umkm_id', $activeQueue->umkm_id)
                        ->where('status', 'pending')
                        ->whereDate('created_at', \Carbon\Carbon::today())
                        ->oldest()
                        ->first();
                    if ($nextOrder) {
                        $servingQueue = $nextOrder->queue_number;
                    }
                }
            }
        }

        // 2. Get New UMKMs (Recommendations)
        $newUmkms = \App\Models\UMKM::where('status', 'approved')
            ->latest() // order by created_at desc
            ->take(6)
            ->get();

        // 3. Get Recommended UMKMs (Random)
        $recommendedUmkms = \App\Models\UMKM::where('status', 'approved')
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('backend.dashboard.index', compact('activeQueue', 'newUmkms', 'recommendedUmkms', 'peopleAhead', 'servingQueue'));
    }
}