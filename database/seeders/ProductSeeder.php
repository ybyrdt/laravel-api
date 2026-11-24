<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = Category::where('nama', 'Makanan')->first();
        $minuman = Category::where('nama', 'Minuman')->first();
        $snack = Category::where('nama', 'Snack')->first();

        $products = [
            ['nama' => 'Ayam Geprek', 'harga' => 12000, 'stok' => 50, 'category_id' => $makanan?->id],
            ['nama' => 'Lele Goreng', 'harga' => 10000, 'stok' => 30, 'category_id' => $makanan?->id],
            ['nama' => 'Nasi Goreng', 'harga' => 15000, 'stok' => 20, 'category_id' => $makanan?->id],
            ['nama' => 'Es Teh', 'harga' => 5000, 'stok' => 100, 'category_id' => $minuman?->id],
            ['nama' => 'Jus Alpukat', 'harga' => 12000, 'stok' => 40, 'category_id' => $minuman?->id],
            ['nama' => 'Keripik Singkong', 'harga' => 8000, 'stok' => 60, 'category_id' => $snack?->id],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
