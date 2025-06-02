<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalCount   = Order::count();
        $antriCount   = Order::where('status', 'antri')->count();
        $prosesCount  = Order::where('status', 'proses')->count();
        $selesaiCount = Order::where('status', 'selesai')->count();
        $batalCount   = Order::where('status', 'batal')->count();

        $orders = Order::with(['user', 'shoes.service'])->orderBy('tanggal_order', 'desc')->get();

        return view('admin.dashboard', [
            'totalCount'   => $totalCount,
            'antriCount'   => $antriCount,
            'prosesCount'  => $prosesCount,
            'selesaiCount' => $selesaiCount,
            'batalCount'   => $batalCount,
            'orders'       => $orders,
        ]);
    }
}
