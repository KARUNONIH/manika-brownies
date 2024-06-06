<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function index(){
        return view('user.app');
    }

    public function dataProduct()
{
    $products = Product::all();
    $categories = Kategori::orderBy('namaKategori', 'asc')->get();
    $productData = [];

    foreach ($products as $product) {
        $imageUrl = Storage::url($product->gambar_kue);
        $productData[] = [
            'id' => $product->kode_kue,
            'name' => $product->nama_kue,
            'description' => $product->deskripsi,
            'category' => $product->kategori->namaKategori,
            'price' => $product->harga_kue,
            'image' => $imageUrl,
            'status' => $product->status_bs
        ];
    }

    return response()->json([
        'products' => $productData,
        'categories' => $categories
    ]);
}

}
