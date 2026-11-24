<?php

use App\Models\Category;
use App\Models\Product;

test('dapat menampilkan daftar produk', function () {
    Product::factory(3)->create();

    $response = $this->getJson('/products');

    $response->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nama', 'harga', 'stok', 'category_id', 'category'],
            ],
        ]);
});

test('dapat membuat produk baru', function () {
    $category = Category::factory()->create();

    $response = $this->postJson('/products', [
        'nama' => 'Nasi Goreng',
        'harga' => 15000,
        'stok' => 10,
        'category_id' => $category->id,
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.nama', 'Nasi Goreng')
        ->assertJsonPath('data.harga', 15000)
        ->assertJsonPath('data.category_id', $category->id);

    $this->assertDatabaseHas('products', [
        'nama' => 'Nasi Goreng',
        'harga' => 15000,
        'stok' => 10,
    ]);
});

test('validasi gagal ketika membuat produk tanpa nama', function () {
    $response = $this->postJson('/products', [
        'harga' => 10000,
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['nama']);
});

test('validasi gagal ketika membuat produk tanpa harga', function () {
    $response = $this->postJson('/products', [
        'nama' => 'Produk Test',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['harga']);
});

test('dapat menampilkan detail produk', function () {
    $product = Product::factory()->create();

    $response = $this->getJson("/products/{$product->id}");

    $response->assertOk()
        ->assertJsonPath('data.id', $product->id)
        ->assertJsonPath('data.nama', $product->nama);
});

test('mengembalikan 404 ketika produk tidak ditemukan', function () {
    $response = $this->getJson('/products/999');

    $response->assertNotFound()
        ->assertJsonPath('message', 'Produk tidak ditemukan');
});

test('dapat mengupdate produk', function () {
    $product = Product::factory()->create(['nama' => 'Lama', 'harga' => 5000, 'stok' => 5]);

    $response = $this->putJson("/products/{$product->id}", [
        'nama' => 'Baru',
        'harga' => 9000,
    ]);

    $response->assertOk()
        ->assertJsonPath('data.nama', 'Baru')
        ->assertJsonPath('data.harga', 9000);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'nama' => 'Baru',
        'harga' => 9000,
    ]);
});

test('mengembalikan 404 saat update produk yang tidak ditemukan', function () {
    $response = $this->putJson('/products/999', [
        'nama' => 'Test',
        'harga' => 1000,
    ]);

    $response->assertNotFound();
});

test('dapat menghapus produk', function () {
    $product = Product::factory()->create();

    $response = $this->deleteJson("/products/{$product->id}");

    $response->assertOk()
        ->assertJsonPath('message', 'Produk berhasil dihapus');

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('mengembalikan 404 saat menghapus produk yang tidak ditemukan', function () {
    $response = $this->deleteJson('/products/999');

    $response->assertNotFound();
});

test('dapat menampilkan daftar kategori', function () {
    Category::factory(3)->create();

    $response = $this->getJson('/categories');

    $response->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nama'],
            ],
        ]);
});
