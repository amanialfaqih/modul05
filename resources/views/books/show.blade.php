@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📖 Detail Buku</h3>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="row g-0">

            {{-- COVER --}}
            <div class="col-md-4 p-4 text-center">

                @if($book->cover)
                    <img src="{{ asset('images/books/'.$book->cover) }}" 
                         class="img-fluid rounded-4 shadow"
                         style="width:100%; height:350px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/300x400" 
                         class="img-fluid rounded-4 shadow">
                @endif

            </div>

            {{-- DETAIL --}}
            <div class="col-md-8">

                <div class="card-body p-4">

                    <h2 class="fw-bold mb-3">
                        {{ $book->judul }}
                    </h2>

                    <p class="mb-2">
                        📂 <strong>Kategori :</strong>
                        {{ $book->category->nama_kategori ?? '-' }}
                    </p>

                    <p class="mb-2">
                        ✍️ <strong>Penulis :</strong>
                        {{ $book->penulis }}
                    </p>

                    <p class="mb-2">
                        📅 <strong>Tahun Terbit :</strong>
                        {{ $book->tahun_terbit }}
                    </p>

                    <p class="mb-2">
                        📦 <strong>Stok :</strong>
                        {{ $book->stok }}
                    </p>

                    <p class="mb-3">
                        💰 <strong>Harga :</strong>
                        <span class="text-success fw-bold">
                            Rp {{ number_format($book->harga,0,',','.') }}
                        </span>
                    </p>

                    <hr>

                    {{-- BUTTON --}}
                    <div class="d-flex gap-2 mt-3">

                        <a href="{{ route('add.to.cart', $book->id) }}" 
                           class="btn btn-success">
                            🛒 Tambah ke Keranjang
                        </a>

                        <a href="{{ route('wishlist.add', $book->id) }}" 
                           class="btn btn-warning">
                            ❤️ Wishlist
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection