<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanMakanan;

class BahanMakananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->perPage ?? 5;

        $bahanMakanans = BahanMakanan::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('satuan', 'like', '%' . $search . '%');
        })->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('bahan_makanan.table', compact('bahanMakanans'))->render()
            ]);
        }

        return view('bahan_makanan.index', compact('bahanMakanans'));
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

        return redirect()->route('bahan-makanan.index')
            ->with('success', 'Data berhasil disimpan');
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

        return redirect()->route('bahan-makanan.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(BahanMakanan $bahanMakanan, $id)
    {
        $bahanMakanan = BahanMakanan::find($id);
        $bahanMakanan->delete();

        return redirect()->route('bahan-makanan.index')
            ->with('success', 'Data berhasil diperbarui dihapus');
    }
}
