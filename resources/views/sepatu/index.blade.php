@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Sepatu</h1>
    <a href="{{ route('sepatu.create') }}">Tambah Sepatu</a>
    <ul>
        @foreach ($sepatus as $sepatu)
            <li>
                {{ $sepatu->nama_sepatu }} - {{ $sepatu->jenis_sepatu }} - {{ $sepatu->ukuran }}
                <form action="{{ route('sepatu.destroy', $sepatu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
