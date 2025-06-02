@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="max-w-3xl mx-auto py-8 px-4">

        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 rounded-xl px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-2xl font-semibold mb-2">Dashboard Customer</h1>
        <p class="mb-6 text-gray-600">Halo, {{ Auth::user()->name }}! Berikut ringkasan pesananmu.</p>

        <div class="flex justify-end mb-5">
            <button id="openOrderModal"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-5 py-2 text-sm font-semibold shadow">
                + Buat Order
            </button>
        </div>

        {{-- Statistik --}}
        @include('components.customer.components.order-stats', [
            'orderCount' => $orderCount,
            'processingCount' => $processingCount,
            'finishedCount' => $finishedCount,
        ])

        {{-- Tabel Order --}}
        @include('components.customer.components.order-table', [
            'recentOrders' => $recentOrders,
        ])

        {{-- Modal buat order --}}
        @include('components.customer.components.order-modal')

        {{-- Modal detail --}}
        @include('components.customer.components.order-detail-modal')

        {{-- Modal edit --}}
        @include('components.customer.components.order-edit-modal')

        {{-- Modal zoom gallery --}}
        @include('components.customer.components.image-zoom-modal')
    </div>

    @include('components.customer.components.dashboard-script')
@endsection
