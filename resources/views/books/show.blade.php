@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">Detail Buku</h3>

    <div class="card">
        <div class="row g-0">

            <div class="col-md-4 p-3">

                @if($book->cover)
                    <img src="{{ asset('images/books/'.$book->cover) }}" 
                         class="img-fluid rounded"
                         style="width:100%; height:300px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/300x200" 
                         class="img-fluid rounded">
                @endif

            </div>

            <div class="col-md-8">

                <div class="card-body">

                    <h4 class="card-title">{{ $book->judul }}</h4>

                    <p class="card-text">
                        <strong>Kategori :</strong>
                        {{ $book->category->nama_kategori ?? '-' }}
                    </p>

                    <p class="card-text">
                        <strong>Penulis :</strong>
                        {{ $book->penulis }}
                    </p>

                    <p class="card-text">
                        <strong>Tahun Terbit :</strong>
                        {{ $book->tahun_terbit }}
                    </p>

                    <p class="card-text">
                        <strong>Stok :</strong>
                        {{ $book->stok }}
                    </p>

                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection