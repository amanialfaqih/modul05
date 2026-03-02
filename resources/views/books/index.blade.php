@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<form method="GET" action="{{ route('books.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search"
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
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
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

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $key => $book)
        <tr>
            <td>{{ $books->firstItem() + $key }}</td>
            <td>{{ $book->category->nama_kategori ?? '-' }}</td>
            <td>{{ $book->judul }}</td>
            <td>{{ $book->penulis }}</td>
            <td>{{ $book->tahun_terbit }}</td>
            <td>{{ $book->stok }}</td>
            <td>
                <a href="{{ route('books.edit',$book->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('books.destroy',$book->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                Data tidak ditemukan
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $books->links() }}

@endsection