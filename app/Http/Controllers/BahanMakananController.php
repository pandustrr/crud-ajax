<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanMakanan;

class BahanMakananController extends Controller
{
    public function index()
    {
        return view('bahan_makanan.index');
    }

    public function data(Request $request)
    {
        $search = $request->search;
        $perPage = $request->perPage ?? 5;

        $bahanMakanans = BahanMakanan::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('satuan', 'like', '%' . $search . '%');
        })->paginate($perPage);

        return view('bahan_makanan.table', compact('bahanMakanans'))->render();
    }

    public function create()
    {
        return view('bahan_makanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        BahanMakanan::create($request->all());

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'redirect' => route('bahan-makanan.index')
        ]);
    }

    public function edit(BahanMakanan $bahanMakanan)
    {
        return view('bahan_makanan.edit', compact('bahanMakanan'));
    }

    public function update(Request $request, BahanMakanan $bahanMakanan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        $bahanMakanan->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'redirect' => route('bahan-makanan.index')
        ]);
    }

    public function destroy(BahanMakanan $bahanMakanan)
    {
        $bahanMakanan->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
