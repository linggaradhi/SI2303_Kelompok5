<div id="detailOrderModal" class="fixed z-50 inset-0 bg-black/30 flex items-center justify-center hidden transition">
    <div class="bg-white rounded-2xl shadow-lg max-w-xl w-full p-6 relative max-h-[95vh] overflow-y-auto">
        <button id="closeDetailOrderModal"
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h2 class="text-lg font-bold mb-4">Detail Order</h2>
        <div id="detail-order-content">
            {{-- Konten detail diisi JS, tombol edit & batal juga diisi JS --}}
        </div>
    </div>
</div>

<form id="formCancelOrder" method="POST" class="hidden">
    @csrf
</form>
