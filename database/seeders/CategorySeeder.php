<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Makanan', 'Minuman', 'Snack', 'Elektronik', 'Pakaian'];

        foreach ($categories as $nama) {
            Category::create(['nama' => $nama]);
        }
    }
}
