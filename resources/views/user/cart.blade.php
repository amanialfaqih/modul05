@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">🛒 Keranjang Belanja</h3>
        <span class="text-muted small">Cek pesanan kamu</span>
    </div>

    @php 
        $total = 0; 
        $totalQty = 0;
    @endphp

    @if(session('cart') && count(session('cart')) > 0)

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th class="text-start">Buku</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach(session('cart') as $id => $item)

                        @php
                            $harga = $item['harga'] ?? 0;
                            $qty = $item['qty'] ?? 1;

                            $subtotal = $harga * $qty;
                            $total += $subtotal;
                            $totalQty += $qty;
                        @endphp

                        <tr>

                            <td class="fw-semibold">
                                {{ $item['judul'] }}
                            </td>

                            <td class="text-center">
                                Rp {{ number_format($harga,0,',','.') }}
                            </td>

                            <td class="text-center">
                                {{ $qty }}
                            </td>

                            <td class="text-center fw-bold text-success">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('remove.cart', $id) }}"
                                   class="btn btn-danger btn-sm">
                                   Hapus
                                </a>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            {{-- TOTAL --}}
            <div class="row mt-4">

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded shadow-sm">
                        <h6>Total Item</h6>
                        <h4>{{ $totalQty }} item</h4>
                    </div>
                </div>

                <div class="col-md-6 text-end">
                    <div class="p-3 bg-success text-white rounded shadow">
                        <h6>Total Belanja</h6>
                        <h3>
                            Rp {{ number_format($total,0,',','.') }}
                        </h3>
                    </div>
                </div>

            </div>

            {{-- CHECKOUT --}}
            <form action="{{ route('checkout') }}"
                  method="POST"
                  class="mt-4">

                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Metode Pembayaran
                    </label>

                    <select name="metode_pembayaran"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Pembayaran --
                        </option>

                        <option value="Transfer Bank">
                            Transfer Bank
                        </option>

                        <option value="E-Wallet">
                            E-Wallet
                        </option>

                        <option value="COD">
                            COD
                        </option>

                    </select>
                </div>

                <button class="btn btn-success w-100 py-2">
                    💳 Checkout Sekarang
                </button>

            </form>

        </div>
    </div>

    @else

        <div class="text-center py-5">
            <h4 class="text-muted mb-3">
                🛒 Keranjang Kosong
            </h4>

            <a href="{{ route('shop') }}"
               class="btn btn-success">
               Belanja Sekarang
            </a>
        </div>

    @endif

</div>

@endsection