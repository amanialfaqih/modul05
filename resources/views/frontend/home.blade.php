@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- HERO / BANNER --}}
    <div class="mb-5">

        <div class="position-relative">

            <img src="{{ asset('images/banner-buku.jpg') }}"
                 class="w-100 rounded shadow"
                 style="height:350px; object-fit:cover;">

            <div class="position-absolute top-50 start-50 translate-middle text-center">

                <h1 class="text-white fw-bold"
                    style="background:rgba(0,0,0,0.6); padding:15px 30px; border-radius:8px;">

                    Amani Bookstore

                </h1>

            </div>

        </div>

    </div>


    <div class="text-center mb-4">
        <h3>Books Collection</h3>
    </div>


    <div class="row">

        @foreach($books as $book)

        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow-sm card-hover">

                {{-- COVER --}}
                @if($book->cover)

                <img src="{{ asset('images/books/'.$book->cover) }}"
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                @else

                <img src="https://via.placeholder.com/300x200"
                     class="card-img-top">

                @endif


                <div class="card-body">

                    <h5 class="card-title">
                        {{ $book->judul }}
                    </h5>

                    <p class="mb-1">
                        Author: {{ $book->penulis }}
                    </p>

                    <p class="mb-2">
                        Year: {{ $book->tahun_terbit }}
                    </p>

                    <a href="{{ route('books.show',$book->id) }}"
                       class="btn btn-primary btn-sm">

                       Detail

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>


<style>

.card-hover{
    transition:0.3s;
}

.card-hover:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

</style>

@endsection