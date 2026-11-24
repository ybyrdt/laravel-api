@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="page-header">
        <h1>Daftar Produk</h1>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="card">
        @if ($products->isEmpty())
            <p style="text-align:center; color:#6c757d; padding:2rem 0;">
                Belum ada produk. <a href="{{ route('produk.create') }}">Tambah sekarang</a>.
            </p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $index }}</td>
                            <td>{{ $product->nama }}</td>
                            <td>
                                @if ($product->category)
                                    <span class="badge badge-info">{{ $product->category->nama }}</span>
                                @else
                                    <span style="color:#aaa;">—</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $product->stok > 10 ? 'badge-info' : 'badge-warning' }}">
                                    {{ $product->stok }}
                                </span>
                            </td>
                            <td style="display:flex; gap:.4rem; flex-wrap:wrap;">
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>

                                {{-- Hapus dengan konfirmasi --}}
                                <form action="{{ route('produk.destroy', $product) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk \"{{ addslashes($product->nama) }}\"?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="pagination">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
