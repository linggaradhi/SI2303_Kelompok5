@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Sepatu</h1>
    <form action="{{ route('sepatu.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_sepatu" placeholder="Nama Sepatu"><br>
        <input type="text" name="jenis_sepatu" placeholder="Jenis Sepatu"><br>
        <input type="text" name="ukuran" placeholder="Ukuran"><br>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
