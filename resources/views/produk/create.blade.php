@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="page-header">
        <h1>Tambah Produk</h1>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card" style="max-width:580px;">
        <form action="{{ route('produk.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text"
                       id="nama"
                       name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Contoh: Ayam Geprek"
                       class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id"
                        name="category_id"
                        class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number"
                       id="harga"
                       name="harga"
                       value="{{ old('harga') }}"
                       min="0"
                       placeholder="Contoh: 12000"
                       class="{{ $errors->has('harga') ? 'is-invalid' : '' }}">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stok --}}
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number"
                       id="stok"
                       name="stok"
                       value="{{ old('stok') }}"
                       min="0"
                       placeholder="Contoh: 50"
                       class="{{ $errors->has('stok') ? 'is-invalid' : '' }}">
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; gap:.6rem; margin-top:1.4rem;">
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
