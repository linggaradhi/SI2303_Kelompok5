<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $services = Service::all();
        $orderCount = $user->orders()->count();
        $processingCount = $user->orders()->where('status', 'proses')->count();
        $finishedCount = $user->orders()->where('status', 'selesai')->count();
        $recentOrders = Order::with(['shoes.service'])
            ->where('user_id', auth()->id())
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('customer.dashboard', compact(
            'orderCount',
            'processingCount',
            'finishedCount',
            'recentOrders',
            'services'
        ));
    }
}
