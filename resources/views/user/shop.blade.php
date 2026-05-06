@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold m-0">🛍️ Shop Buku</h3>
            <small class="text-muted">Temukan buku favoritmu</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('wishlist') }}" class="btn btn-outline-danger shadow-sm">
                ❤️ Wishlist
            </a>

            <a href="{{ route('cart') }}" class="btn btn-warning shadow-sm">
                🛒 Keranjang
            </a>
        </div>
    </div>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        @foreach($books as $book)
        <div class="col-md-3">

            <div class="card product-card border-0 h-100">

                {{-- IMAGE + OVERLAY --}}
                <div class="position-relative overflow-hidden">

                    @if($book->cover)
                    <img src="{{ asset('images/books/'.$book->cover) }}"
                         class="card-img-top"
                         style="height:230px; object-fit:cover;">
                    @endif

                    {{-- ❤️ WISHLIST --}}
                    <a href="{{ route('wishlist.add', $book->id) }}"
                       class="wishlist-btn">

                        @if(in_array($book->id, $wishlist ?? []))
                            ❤️
                        @else
                            🤍
                        @endif

                    </a>

                    {{-- KATEGORI --}}
                    <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2">
                        {{ $book->category->nama_kategori ?? 'Umum' }}
                    </span>

                    {{-- OVERLAY --}}
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <a href="{{ route('add.to.cart',$book->id) }}"
                           class="btn btn-light btn-sm px-3">
                           + Keranjang
                        </a>
                    </div>

                </div>

                <div class="card-body d-flex flex-column">

                    <h6 class="fw-bold text-dark mb-1">
                        {{ $book->judul }}
                    </h6>

                    <small class="text-muted mb-2">
                        ✍️ {{ $book->penulis }}
                    </small>

                    <div class="text-warning small mb-1">
                        ⭐⭐⭐⭐☆
                    </div>

                    <div class="mb-3">
                        <span class="fs-5 fw-bold text-success">
                            Rp {{ number_format($book->harga ?? 0,0,',','.') }}
                        </span>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('add.to.cart',$book->id) }}"
                           class="btn btn-success w-100 rounded-pill">
                           🛒 Tambah ke Keranjang
                        </a>
                    </div>

                </div>

            </div>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $books->links() }}
    </div>

</div>

{{-- 🔥 STYLE FIX --}}
<style>

/* CARD */
.product-card {
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    position: relative; /* 🔥 TAMBAHAN */
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* IMAGE */
.product-card img {
    transition: 0.4s ease;
}

.product-card:hover img {
    transform: scale(1.1);
}

/* OVERLAY */
.overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: 0.3s;
    z-index: 1; /* 🔥 TAMBAHAN */
}

.product-card:hover .overlay {
    opacity: 1;
}

/* ❤️ WISHLIST BUTTON FIX */
.wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10; /* 🔥 PALING PENTING */

    background: white;
    border-radius: 50%;
    width: 38px;
    height: 38px;

    display:flex;
    align-items:center;
    justify-content:center;

    text-decoration:none;
    font-size:18px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.wishlist-btn:hover {
    transform: scale(1.2);
}

/* BUTTON */
.btn-success {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* PAGINATION */
.pagination .page-link {
    border-radius: 8px;
    margin: 0 3px;
    color: #6366f1;
}

.pagination .active .page-link {
    background-color: #6366f1;
    border-color: #6366f1;
    color: #fff;
}

</style>

@endsection