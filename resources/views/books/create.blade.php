@extends('layouts.app')

@section('content')

<div class="container">

<h3 class="mb-4">Tambah Book</h3>

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label class="form-label">Kategori</label>
<select name="category_id" class="form-control">
<option value="">-- Pilih Kategori --</option>

@foreach($categories as $cat)
<option value="{{ $cat->id }}">
{{ $cat->nama_kategori }}
</option>
@endforeach

</select>
</div>


<div class="mb-3">
<label class="form-label">Judul</label>
<input type="text" name="judul" class="form-control">
</div>


<div class="mb-3">
<label class="form-label">Penulis</label>
<input type="text" name="penulis" class="form-control">
</div>


<div class="mb-3">
<label class="form-label">Tahun Terbit</label>
<input type="number" name="tahun_terbit" class="form-control">
</div>


<div class="mb-3">
<label class="form-label">Stok</label>
<input type="number" name="stok" class="form-control">
</div>


<div class="mb-3">
<label class="form-label">Cover Buku</label>
<input type="file" name="cover" class="form-control">
</div>


<button type="submit" class="btn btn-success">
Simpan
</button>

<a href="{{ route('books.index') }}" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

@endsection