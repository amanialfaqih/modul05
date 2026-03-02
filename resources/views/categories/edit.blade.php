@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Edit Kategori</h3>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
<div class="card-body">

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text"
               name="nama_kategori"
               value="{{ old('nama_kategori', $category->nama_kategori) }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi"
                  class="form-control"
                  rows="4"
                  required>{{ old('deskripsi', $category->deskripsi) }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">
        Update
    </button>

</form>

</div>
</div>

@endsection