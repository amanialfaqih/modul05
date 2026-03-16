@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<form method="GET" action="{{ route('books.index') }}" class="row mb-3">

    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari Judul..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-4">
        <select name="category" class="form-select">

            <option value="">-- Semua Kategori --</option>

            @foreach($categories as $cat)

            <option value="{{ $cat->id }}"
            {{ request('category') == $cat->id ? 'selected' : '' }}>

            {{ $cat->nama_kategori }}

            </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-4">
        <button class="btn btn-info text-white">Filter</button>

        <a href="{{ route('books.index') }}"
           class="btn btn-secondary">
           Reset
        </a>
    </div>

</form>


<div class="mb-3">
<strong>Total Semua Book:</strong>

<span class="badge bg-success">

{{ $totalBooks }}

</span>

</div>


@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



<div class="row">

@forelse($books as $book)

<div class="col-md-3 mb-4">

<div class="card shadow h-100">


@if($book->cover)

<img src="{{ asset('images/books/'.$book->cover) }}"
class="card-img-top"
style="height:200px; object-fit:cover;">

@endif



<div class="card-body">

<h5 class="card-title">

{{ $book->judul }}

</h5>


<p class="card-text">

Kategori :
{{ $book->category->nama_kategori ?? '-' }}

<br>

Penulis :
{{ $book->penulis }}

<br>

Tahun :
{{ $book->tahun_terbit }}

<br>

Stok :
{{ $book->stok }}

</p>



<a href="{{ route('books.edit',$book->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>



<form action="{{ route('books.destroy',$book->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus?')">

Hapus

</button>

</form>


</div>

</div>

</div>


@empty

<div class="col-12 text-center">

Data tidak ditemukan

</div>

@endforelse

</div>



<div class="mt-3">

{{ $books->links() }}

</div>

@endsection