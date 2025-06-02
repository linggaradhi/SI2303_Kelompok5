<div id="orderModal" class="fixed z-50 inset-0 bg-black/30 flex items-center justify-center hidden transition">
    <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-6 relative max-h-[95vh] overflow-y-auto">
        <button id="closeOrderModal"
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h2 class="text-lg font-bold mb-4">Buat Order Baru</h2>
        <form action="{{ route('customer.orders.store') }}" method="POST" enctype="multipart/form-data" id="formOrderModal"
            class="space-y-4">
            @csrf
            <div id="shoes-list">
                <div class="shoe-row border-b pb-4 mb-4">
                    <div class="font-medium mb-2">Sepatu <span class="shoe-number">1</span></div>
                    <div class="mb-2">
                        <label class="block mb-1">Merk Sepatu</label>
                        <input type="text" name="merk[]" required class="w-full border rounded-lg px-3 py-2" />
                    </div>
                    <div class="mb-2">
                        <label class="block mb-1">Warna Sepatu</label>
                        <input type="text" name="warna[]" required class="w-full border rounded-lg px-3 py-2" />
                    </div>
                    <div class="mb-2">
                        <label class="block mb-1">Tipe/Jenis Sepatu</label>
                        <input type="text" name="tipe[]" required class="w-full border rounded-lg px-3 py-2" />
                    </div>
                    <div class="mb-2">
                        <label class="block mb-1">Layanan Cuci</label>
                        <select name="service_id[]" required class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->nama }} (Rp{{ number_format($service->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="block mb-1">Foto Sepatu</label>
                        <input type="file" name="foto[]" accept="image/*"
                            class="w-full border rounded-lg px-3 py-2" />
                    </div>
                    <button type="button"
                        class="remove-shoe bg-red-100 text-red-700 rounded px-2 py-1 text-xs mt-2 hidden">Hapus
                        Sepatu</button>
                </div>
            </div>
            <button type="button" id="add-shoe"
                class="bg-green-600 hover:bg-green-700 text-white rounded-xl px-4 py-2 text-sm font-semibold shadow mb-2">
                + Tambah Sepatu
            </button>
            <div>
                <label class="block mb-1 font-medium">Catatan Order (opsional)</label>
                <textarea name="catatan" rows="2" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="cancelOrderModal" class="text-gray-600 hover:underline mr-4">Batal</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-semibold shadow">
                    Simpan Order
                </button>
            </div>
        </form>
    </div>
</div>
