@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">❤️ Wishlist</h3>

<div class="row">
@forelse($data as $item)

<div class="col-md-3">
    <div class="card p-3 text-center">

        <h6>{{ $item->book->judul }}</h6>
        <p>Rp {{ number_format($item->book->harga,0,',','.') }}</p>

        <a href="{{ route('add.to.cart',$item->book->id) }}"
           class="btn btn-success btn-sm">🛒 Beli</a>

        <a href="{{ route('wishlist.remove',$item->book->id) }}"
           class="btn btn-danger btn-sm mt-2">Hapus</a>
    </div>
</div>

@empty
<p class="text-muted">Wishlist kosong</p>
@endforelse
</div>

@endsection