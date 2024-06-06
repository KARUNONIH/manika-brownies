<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        return view('admin.kategori.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaKategori' => 'required',
        ]);
        Kategori::create($validated);

        return redirect()->route('admin.index')->with('success', 'Kategori berhasil ditambahkan!');

    }
    public function update(Request $request, $id)
    {
        $kategori = kategori::findOrFail($id);

        $validated = $request->validate([
            'namaKategori' => 'required',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.index')->with('success', 'Kategori berhasil edit!');
        // $request->validate([
        //     'namaKategori' => 'required|string|max:255',
        // ]);

        // $kategori = Kategori::find($id);

        // if (!$kategori) {
        //     return redirect()->route('admin.index')->with('error', 'Kategori tidak ditemukan');
        // }

        // $kategori->namaKategori = $request->namaKategori;
        // $kategori->save();

        // return redirect()->route('admin.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()->route('admin.index')->with('error', 'Kategori tidak ditemukan');
        }

        $kategori->delete();

        return redirect()->route('admin.index')->with('success', 'Kategori berhasil dihapus');
    }
}
