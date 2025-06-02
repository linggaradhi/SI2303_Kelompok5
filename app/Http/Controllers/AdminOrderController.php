<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:antri,proses,selesai,batal',
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin.dashboard')->with('success', 'Status order diperbarui!');
    }
}
