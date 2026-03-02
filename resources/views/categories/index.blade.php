@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Kategori</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        + Tambah
    </a>
</div>

<form method="GET" action="{{ route('categories.index') }}" class="row g-2 mb-3 align-items-center">

    {{-- SEARCH --}}
    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari Nama Kategori..."
               value="{{ request('search') }}">
    </div>

    {{-- DROPDOWN --}}
    <div class="col-md-4">
        <select name="kategori_id" class="form-select">
            <option value="">-- Semua Kategori --</option>

            @foreach($allCategories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('kategori_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nama_kategori }}
                </option>
            @endforeach

        </select>
    </div>

    {{-- BUTTON --}}
    <div class="col-md-4">
        <button class="btn btn-info text-white">Filter</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            Reset
        </a>
    </div>

</form>

<div class="mb-3">
    <strong>Total Semua Kategori:</strong>
    <span class="badge bg-success">
        {{ $totalCategories }}
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
            <th width="60">No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $key => $category)
        <tr>
            <td>{{ $categories->firstItem() + $key }}</td>
            <td>{{ $category->nama_kategori }}</td>
            <td>{{ $category->deskripsi }}</td>
            <td>
                <a href="{{ route('categories.edit',$category->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('categories.destroy',$category->id) }}"
                      method="POST"
                      class="d-inline">
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
            <td colspan="4" class="text-center">
                Data tidak ditemukan
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $categories->links() }}
</div>

@endsection