<div class="grid gap-6 md:grid-cols-3 mb-10">
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm text-gray-500 mb-1">Total Order</div>
        <div class="text-3xl font-bold mb-2">{{ $orderCount ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm text-gray-500 mb-1">Sedang Diproses</div>
        <div class="text-3xl font-bold mb-2">{{ $processingCount ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm text-gray-500 mb-1">Order Selesai</div>
        <div class="text-3xl font-bold mb-2">{{ $finishedCount ?? 0 }}</div>
    </div>
</div>
