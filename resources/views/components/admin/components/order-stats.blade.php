<div class="grid gap-6 md:grid-cols-5 mb-10">
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm text-gray-500 mb-1">Total Order</div>
        <div class="text-3xl font-bold mb-2">{{ $totalCount ?? 0 }}</div>
    </div>
    <div class="bg-yellow-100 text-yellow-700 rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm mb-1">Antri</div>
        <div class="text-3xl font-bold mb-2">{{ $antriCount ?? 0 }}</div>
    </div>
    <div class="bg-blue-100 text-blue-700 rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm mb-1">Proses</div>
        <div class="text-3xl font-bold mb-2">{{ $prosesCount ?? 0 }}</div>
    </div>
    <div class="bg-green-100 text-green-700 rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm mb-1">Selesai</div>
        <div class="text-3xl font-bold mb-2">{{ $selesaiCount ?? 0 }}</div>
    </div>
    <div class="bg-red-100 text-red-700 rounded-2xl shadow p-6 flex flex-col items-center">
        <div class="text-sm mb-1">Batal</div>
        <div class="text-3xl font-bold mb-2">{{ $batalCount ?? 0 }}</div>
    </div>
</div>
