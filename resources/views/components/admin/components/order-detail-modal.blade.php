<div id="detailOrderModal"
    class="fixed z-50 inset-0 bg-black/30 flex items-center justify-center hidden transition">
    <div class="bg-white rounded-2xl shadow-lg max-w-xl w-full p-6 relative max-h-[95vh] overflow-y-auto">
        <button id="closeDetailOrderModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        <h2 class="text-lg font-bold mb-4">Detail Order</h2>
        <div class="flex justify-end mb-3">
            <button id="btnPrintOrder" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-1 rounded shadow text-sm font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18v4h12v-4M6 14h.01M18 14h.01M6 18h12a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2z" /></svg>
                Print
            </button>
        </div>
        <div id="detail-order-content-admin"></div>
    </div>
</div>

{{-- Hidden form untuk update status --}}
<form id="formUpdateStatusOrder" method="POST" class="hidden">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" id="inputStatusOrder">
</form>
