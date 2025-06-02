<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'merk.*' => 'required|string|max:255',
            'warna.*' => 'required|string|max:50',
            'tipe.*' => 'required|string|max:50',
            'service_id.*' => 'required|exists:services,id',
            'foto.*' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            // Ambil data service dari DB
            $services = Service::whereIn('id', $request->service_id)->get()->keyBy('id');
            $totalHarga = 0;
            foreach ($request->service_id as $serviceId) {
                $service = $services[$serviceId] ?? null;
                if ($service) $totalHarga += $service->harga;
            }

            // Buat order
            $order = Order::create([
                'user_id' => auth()->id(),
                'tanggal_order' => now(),
                'status' => 'antri',
                'catatan' => $request->catatan,
                'total_harga' => $totalHarga,
            ]);

            // Simpan sepatu
            foreach ($request->merk as $i => $merk) {
                $fotoPath = null;
                if ($request->hasFile("foto.$i")) {
                    $fotoPath = $request->file("foto.$i")->store('sepatu', 'public');
                }
                $serviceId = $request->service_id[$i];
                $order->shoes()->create([
                    'merk' => $merk,
                    'warna' => $request->warna[$i],
                    'tipe' => $request->tipe[$i],
                    'service_id' => $serviceId,
                    'foto' => $fotoPath,
                ]);
            }

            DB::commit();
            return redirect()->route('customer.dashboard')->with('success', 'Order berhasil dibuat!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::with('shoes')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!in_array($order->status, ['antri', 'proses'])) {
            return redirect()->route('customer.orders.show', $id)
                ->with('error', 'Order tidak dapat diedit.');
        }

        $request->validate([
            'merk.*' => 'required|string|max:255',
            'warna.*' => 'required|string|max:50',
            'tipe.*' => 'required|string|max:50',
            'service_id.*' => 'required|exists:services,id',
            'foto.*' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string|max:500',
        ]);

        try {
            DB::transaction(function () use ($request, $order) {
                $services = Service::whereIn('id', $request->service_id)->get()->keyBy('id');
                $totalHarga = 0;
                foreach ($request->service_id as $serviceId) {
                    $service = $services[$serviceId] ?? null;
                    if ($service) $totalHarga += $service->harga;
                }

                $order->update([
                    'catatan' => $request->catatan,
                    'total_harga' => $totalHarga,
                ]);

                $order->shoes()->delete();

                foreach ($request->merk as $i => $merk) {
                    $fotoPath = null;
                    if ($request->hasFile("foto.$i")) {
                        $fotoPath = $request->file("foto.$i")->store('sepatu', 'public');
                    }
                    $serviceId = $request->service_id[$i];
                    $order->shoes()->create([
                        'merk' => $merk,
                        'warna' => $request->warna[$i],
                        'tipe' => $request->tipe[$i],
                        'service_id' => $serviceId,
                        'foto' => $fotoPath,
                    ]);
                }
            });
            return redirect()->route('customer.dashboard')
                ->with('success', 'Order berhasil diedit!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal update order: ' . $e->getMessage());
        }
    }


    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['antri', 'proses'])
            ->firstOrFail();

        $order->update([
            'status' => 'batal',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Order berhasil dibatalkan.');
    }
}
