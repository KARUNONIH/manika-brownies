<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $originalOrder = Product::pluck('kode_kue')->toArray();
        $products = Product::orderBy('kode_kue')->get();

        foreach ($products as $product) {
            $newOrder = array_search($product->id, $originalOrder);
            $product->update(['order' => $newOrder]);
        }
        // dd($products);
        return view('admin.app', compact('products'));
    }

    public function create()
    {
        return view('myadmin.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_kue' => 'required',
        'deskripsi' => 'required',
        'kode_kategori' => 'required',
        'harga_kue' => 'required|numeric',
        'gambar_kue' => 'image|nullable',
    ]);

    if ($request->hasFile('gambar_kue')) {
        $validated['gambar_kue'] = $request->file('gambar_kue')->store('images', 'public');
    }
    Product::create($validated);

    return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan!');
}


    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('myadmin.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
            'harga_kue' => 'required|numeric',
            'gambar_kue' => 'image|nullable',
        ]);

        if ($request->hasFile('gambar_kue')) {
            if ($product->gambar_kue) {
                Storage::delete('public/' . $product->gambar_kue);
            }
            $validated['gambar_kue'] = $request->file('gambar_kue')->store('images', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.index')->with('success', 'Data berhasil edit!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->gambar_kue) {
            Storage::delete('public/' . $product->gambar_kue);
        }
        $product->delete();
        return redirect()->route('myadmin.index')->with('success', 'Data berhasil dihapus!');
    }

    public function setBestSeller(Request $request, $kode_kue)
{
    $product = Product::findOrFail($kode_kue);
    $status = filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN);

    // Jika mengubah status menjadi true dan sudah ada 4 produk dengan status true
    if ($status && Product::where('status_bs', true)->count() >= 4) {
        // Ambil satu produk dengan status true dan ubah menjadi false
        $productToChange = Product::where('status_bs', true)->first();
        if ($productToChange) {
            $productToChange->update(['status_bs' => false]);
        }
    }

    // Update status produk saat ini
    $product->update(['status_bs' => $status]);

    return response()->json(['success' => true]);
}

}
