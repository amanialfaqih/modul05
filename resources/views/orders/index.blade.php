@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📦 Data Pesanan User</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-dark text-center">
                        <tr>
                            <th>User</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                        <tr>

                            <td>
                                {{ $order->user->name ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format($order->total,0,',','.') }}
                            </td>

                            <td>
                                {{ $order->metode_pembayaran }}
                            </td>

                            <td>

                                @if($order->status == 'pending')

                                    <span class="badge bg-warning">
                                        Pending
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Approved
                                    </span>

                                @endif

                            </td>

                            <td>

                                @foreach($order->items as $item)

                                    <div class="mb-2">
                                        📚 {{ $item->judul }}
                                        ({{ $item->qty }}x)
                                    </div>

                                @endforeach

                            </td>

                            <td>

                                @if($order->status == 'pending')

                                <a href="{{ route('orders.approve',$order->id) }}"
                                   class="btn btn-success btn-sm">

                                   Approve

                                </a>

                                @else

                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Selesai
                                    </button>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada pesanan
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection