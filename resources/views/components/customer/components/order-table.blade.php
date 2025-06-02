<div>
    <h2 class="text-lg font-semibold mb-3">Order Terbaru</h2>
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-4">Tanggal Order</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Sepatu</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders ?? [] as $order)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-4">
                            {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}
                            <div class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($order->tanggal_order)->diffForHumans() }}
                            </div>
                        </td>
                        <td class="p-4">
                            <span
                                class="px-2 py-1 rounded-xl text-xs font-medium
                                @if ($order->status == 'antri') bg-yellow-100 text-yellow-700
                                @elseif($order->status == 'proses') bg-blue-100 text-blue-700
                                @elseif($order->status == 'selesai') bg-green-100 text-green-700
                                @elseif($order->status == 'batal') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-600 @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="p-4">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="p-4">
                            @if (!empty($order->shoes) && count($order->shoes ?? []))
                                <div class="flex space-x-2">
                                    @foreach(($order->shoes ?? []) as $shoeIdx => $shoe)
                                        @if ($shoe->foto)
                                            <img src="{{ asset('storage/' . $shoe->foto) }}" alt="Sepatu"
                                                class="w-10 h-10 object-cover rounded cursor-pointer img-zoomable"
                                                title="{{ $shoe->merk }}" data-group="order-{{ $order->id }}"
                                                data-index="{{ $shoeIdx }}">
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <button class="text-blue-600 hover:underline text-xs open-detail-modal"
                                data-order="{{ $order->toJson() }}" data-shoes="{{ $order->shoes->toJson() }}"
                                @if (isset($order->user)) data-customer="{{ $order->user->name }}" @endif>
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-gray-500" colspan="5">Belum ada order terbaru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
