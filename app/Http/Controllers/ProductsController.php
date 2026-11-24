<?php

namespace App\Http\Controllers;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json([
            [
                'id' => 1,
                'nama' => 'Ayam Geprek',
                'harga' => 12000,
            ],
            [
                'id' => 2,
                'nama' => 'Lele Goreng',
                'harga' => 10000,
            ],
        ]);
    }

    public function show($id)
    {
        $products = [
            1 => ['id' => 1, 'nama' => 'Ayam Geprek', 'harga' => '12000'],
            2 => ['id' => 2, 'nama' => 'Lele Goreng', 'harga' => '10000'],
        ];

        if (! isset($products[$id])) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json($products[$id]);
    }
}
