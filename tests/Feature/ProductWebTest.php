<?php

use App\Models\Category;
use App\Models\Product;

test('halaman daftar produk dapat diakses', function () {
    Product::factory(3)->create();

    $response = $this->get(route('produk.index'));

    $response->assertOk()
        ->assertViewIs('produk.index')
        ->assertViewHas('products');
});

test('halaman daftar produk menampilkan pagination', function () {
    Product::factory(15)->create();

    $response = $this->get(route('produk.index'));

    $response->assertOk()
        ->assertSee('pagination', false);
});

test('halaman tambah produk dapat diakses', function () {
    Category::factory()->create();

    $response = $this->get(route('produk.create'));

    $response->assertOk()
        ->assertViewIs('produk.create')
        ->assertViewHas('categories');
});

test('dapat menyimpan produk baru melalui web', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('produk.store'), [
        'nama' => 'Mie Goreng',
        'harga' => 10000,
        'stok' => 25,
        'category_id' => $category->id,
    ]);

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'nama' => 'Mie Goreng',
        'harga' => 10000,
        'stok' => 25,
        'category_id' => $category->id,
    ]);
});

test('validasi gagal ketika store tanpa nama', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('produk.store'), [
        'harga' => 10000,
        'stok' => 10,
        'category_id' => $category->id,
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['nama']);
});

test('validasi gagal ketika store tanpa harga', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('produk.store'), [
        'nama' => 'Produk Test',
        'stok' => 10,
        'category_id' => $category->id,
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['harga']);
});

test('validasi gagal ketika store tanpa stok', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('produk.store'), [
        'nama' => 'Produk Test',
        'harga' => 5000,
        'category_id' => $category->id,
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['stok']);
});

test('halaman edit produk dapat diakses', function () {
    $product = Product::factory()->create();
    Category::factory()->create();

    $response = $this->get(route('produk.edit', $product));

    $response->assertOk()
        ->assertViewIs('produk.edit')
        ->assertViewHas('produk', $product)
        ->assertViewHas('categories');
});

test('dapat mengupdate produk melalui web', function () {
    $product = Product::factory()->create(['nama' => 'Lama', 'harga' => 5000, 'stok' => 10]);
    $category = Category::factory()->create();

    $response = $this->put(route('produk.update', $product), [
        'nama' => 'Baru',
        'harga' => 9000,
        'stok' => 20,
        'category_id' => $category->id,
    ]);

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'nama' => 'Baru',
        'harga' => 9000,
        'stok' => 20,
    ]);
});

test('dapat menghapus produk melalui web', function () {
    $product = Product::factory()->create();

    $response = $this->delete(route('produk.destroy', $product));

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});
