<div id="editOrderModal"
    class="fixed z-50 inset-0 bg-black/30 flex items-center justify-center hidden transition">
    <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-6 relative max-h-[95vh] overflow-y-auto">
        <button id="closeEditOrderModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h2 class="text-lg font-bold mb-4">Edit Order</h2>
        <form method="POST" enctype="multipart/form-data" id="formEditOrder" class="space-y-4">
            @csrf
            @method('PUT')
            <div id="edit-shoes-list"></div>
            <button type="button" id="add-edit-shoe"
                class="bg-green-600 hover:bg-green-700 text-white rounded-xl px-4 py-2 text-sm font-semibold shadow mb-2">
                + Tambah Sepatu
            </button>
            <div>
                <label class="block mb-1 font-medium">Catatan Order (opsional)</label>
                <textarea name="catatan" id="edit-order-catatan" rows="2"
                    class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="cancelEditOrderModal" class="text-gray-600 hover:underline mr-4">Batal</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-semibold shadow">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
