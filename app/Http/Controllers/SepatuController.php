<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepatu;

class SepatuController extends Controller
{
    public function index()
    {
        $sepatus = Sepatu::all();
        return view('sepatu.index', compact('sepatus'));
    }

    public function create()
    {
        return view('sepatu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sepatu' => 'required',
            'jenis_sepatu' => 'required',
            'ukuran' => 'required',
        ]);

        Sepatu::create($request->all());

        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $sepatu = Sepatu::findOrFail($id);
        $sepatu->delete();

        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus!');
    }
}

