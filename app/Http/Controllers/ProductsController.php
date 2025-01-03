<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    // Menampilkan product berdasarkan kategori
    public function showByCategory($category)
{
    // Ambil produk berdasarkan kategori slug
    $products = Product::whereHas('category', function ($query) use ($category) {
        $query->where('slug', $category); // Pastikan kategori memiliki slug
    })->get();

    // Ambil nama kategori berdasarkan slug
    $categoryName = \App\Models\Category::where('slug', $category)->first()->name;

    // Kirim data kategori dan produk ke view
    return view('products.index', compact('products', 'category', 'categoryName'));
}

public function show($slug)
{
    // Cari produk berdasarkan slug dan pastikan relasi category dimuat
    $product = Product::with('category')->where('slug', $slug)->first();

    if (!$product) {
        abort(404, 'Produk tidak ditemukan');
    }

    // Mengambil nama kategori atau 'Kategori tidak ditemukan' jika kategori tidak ada
    $categoryName = $product->category ? $product->category->name : 'Kategori tidak ditemukan';

    // Mengirim data ke view
    return view('products.detail', compact('product', 'categoryName'));
}


}