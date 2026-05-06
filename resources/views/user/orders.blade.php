@extends('layouts.app')

@section('content')

<h3 class="mb-4">📦 Pesanan Saya</h3>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@php
$orders = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
@endphp

@forelse($orders as $order)

<div class="card mb-3 p-3">
    <h6>Order #{{ $order->id }}</h6>
    <small>{{ $order->created_at }}</small>

    <ul class="mt-2">
        @foreach($order->items as $item)
            <li>
                {{ $item->judul }} ({{ $item->qty }}) - 
                Rp {{ number_format($item->harga * $item->qty,0,',','.') }}
            </li>
        @endforeach
    </ul>

    <strong>Total: Rp {{ number_format($order->total,0,',','.') }}</strong>
</div>

@empty
<p class="text-muted">Belum ada pesanan</p>
@endforelse

@endsection