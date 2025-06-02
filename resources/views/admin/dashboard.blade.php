@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="max-w-5xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-2">Dashboard Admin</h1>
    <p class="mb-6 text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>

    @include('components.admin.components.order-stats', [
        'totalCount' => $totalCount,
        'antriCount' => $antriCount,
        'prosesCount' => $prosesCount,
        'selesaiCount' => $selesaiCount,
        'batalCount' => $batalCount,
    ])

    @include('components.admin.components.order-table', [
        'orders' => $orders
    ])

    @include('components.admin.components.order-detail-modal')
</div>
@include('components.admin.components.dashboard-script')
@endsection
