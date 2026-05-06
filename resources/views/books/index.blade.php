@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📚 Data Book</h3>

        <div class="d-flex gap-2 flex-wrap">

            <a href="{{ route('books.create') }}" class="btn btn-success">
                + Tambah
            </a>

            <a href="{{ route('books.pdf') }}" class="btn btn-danger">
                PDF
            </a>

            <a href="{{ route('books.excel') }}" class="btn btn-primary">
                Excel
            </a>

            <a href="{{ route('shop') }}" class="btn btn-dark">
                Shop
            </a>

            <a href="{{ route('cart') }}" class="btn btn-warning">
                Keranjang
            </a>

            {{-- 🔥 BARU --}}
            <a href="{{ route('orders.index') }}" class="btn btn-info text-white">
                Pesanan User
            </a>

        </div>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('books.index') }}" class="row g-3 mb-4">

        <div class="col-md-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="🔍 Cari Judul..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select">

                <option value="">
                    -- Semua Kategori --
                </option>

                @foreach($categories as $cat)

                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>

                        {{ $cat->nama_kategori }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">

            <button class="btn btn-success w-50">
                Filter
            </button>

            <a href="{{ route('books.index') }}"
               class="btn btn-secondary w-50">

               Reset

            </a>

        </div>

    </form>

    {{-- TOTAL --}}
    <div class="mb-3">

        <span class="badge bg-success px-3 py-2">
            Total Book: {{ $totalBooks }}
        </span>

    </div>

    {{-- NOTIF --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    {{-- LIST --}}
    <div class="row g-4">

        @forelse($books as $book)

        <div class="col-md-3">

            <div class="card product-card h-100 border-0 shadow-sm">

                {{-- IMAGE --}}
                <div class="position-relative overflow-hidden">

                    @if($book->cover)

                    <img src="{{ asset('images/books/'.$book->cover) }}"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">

                    @endif

                    <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2 shadow-sm">

                        {{ $book->category->nama_kategori ?? 'Umum' }}

                    </span>

                </div>

                <div class="card-body d-flex flex-column">

                    {{-- JUDUL --}}
                    <h6 class="fw-bold mb-1 text-dark">
                        {{ $book->judul }}
                    </h6>

                    {{-- PENULIS --}}
                    <small class="text-muted mb-2">
                        ✍️ {{ $book->penulis }}
                    </small>

                    {{-- RATING --}}
                    <div class="text-warning small mb-1">
                        ⭐⭐⭐⭐☆
                    </div>

                    {{-- HARGA --}}
                    <div class="mb-3">

                        <span class="fs-5 fw-bold text-success">

                            Rp {{ number_format($book->harga ?? 0,0,',','.') }}

                        </span>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-auto d-flex gap-2">

                        <a href="{{ route('books.edit',$book->id) }}"
                           class="btn btn-warning btn-sm w-50">

                           Edit

                        </a>

                        <form action="{{ route('books.destroy',$book->id) }}"
                              method="POST"
                              class="w-50">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm w-100">

                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="text-center text-muted py-5">

            <h5>Data tidak ditemukan</h5>

        </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center">

        {{ $books->links() }}

    </div>

</div>

<style>

.product-card{
    border-radius:16px;
    overflow:hidden;
    transition:all .3s ease;
}

.product-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

.product-card img{
    transition:.4s;
}

.product-card:hover img{
    transform:scale(1.08);
}

</style>

@endsection