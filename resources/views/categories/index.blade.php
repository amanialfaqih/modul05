@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📂 Data Kategori</h3>

        <a href="{{ route('categories.create') }}" class="btn btn-success rounded-pill shadow-sm">
            + Tambah
        </a>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('categories.index') }}" class="row g-3 mb-4">

        <div class="col-md-4">
            <input type="text" name="search" class="form-control shadow-sm"
                   placeholder="🔍 Cari Nama Kategori..." value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="kategori_id" class="form-select shadow-sm">
                <option value="">-- Semua Kategori --</option>
                @foreach($allCategories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('kategori_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-success w-50">Filter</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary w-50">Reset</a>
        </div>

    </form>

    {{-- TOTAL --}}
    <div class="mb-3">
        <span class="badge bg-success px-3 py-2 shadow-sm">
            Total Kategori: {{ $totalCategories }}
        </span>
    </div>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($categories as $key => $category)
                    <tr>

                        <td class="text-center fw-semibold">
                            {{ $categories->firstItem() + $key }}
                        </td>

                        <td class="fw-semibold">
                            {{ $category->nama_kategori }}
                        </td>

                        <td class="text-muted">
                            {{ $category->deskripsi ?? '-' }}
                        </td>

                        {{-- 🔥 FIX BUTTON --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('categories.edit',$category->id) }}"
                                   class="btn btn-warning btn-sm rounded-pill px-3">
                                   Edit
                                </a>

                                <form action="{{ route('categories.destroy',$category->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm rounded-pill px-3">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <h6>Data tidak ditemukan</h6>
                        </td>
                    </tr>
                    @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

</div>

@endsection