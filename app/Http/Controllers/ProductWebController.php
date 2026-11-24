<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductWebRequest;
use App\Http\Requests\UpdateProductWebRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductWebController extends Controller
{
    /**
     * Display a listing of the products with pagination.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('nama')->get();

        return view('produk.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductWebRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $produk): View
    {
        $categories = Category::orderBy('nama')->get();

        return view('produk.edit', compact('produk', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductWebRequest $request, Product $produk): RedirectResponse
    {
        $produk->update($request->validated());

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $produk): RedirectResponse
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
