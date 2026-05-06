<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // =========================
    // CHECKOUT USER
    // =========================
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        // kalau keranjang kosong
        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Keranjang kosong');
        }

        $total = 0;

        // hitung total
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        // simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'pending'
        ]);

        // simpan item
        foreach ($cart as $id => $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $id,
                'judul' => $item['judul'],
                'harga' => $item['harga'],
                'qty' => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty']
            ]);

        }

        // hapus cart
        session()->forget('cart');

        return redirect()->route('cart')
            ->with('success', 'Checkout berhasil, menunggu approve admin');
    }


    // =========================
    // ADMIN LIHAT ORDER
    // =========================
    public function index()
    {
        $orders = Order::with('user','items')
                    ->latest()
                    ->get();

        return view('orders.index', compact('orders'));
    }


    // =========================
    // APPROVE ORDER
    // =========================
    public function approve($id)
    {
        $order = Order::with('items.book')->findOrFail($id);

        // kurangi stok
        foreach ($order->items as $item) {

            $book = $item->book;

            if ($book) {
                $book->stok -= $item->qty;
                $book->save();
            }

        }

        // update status
        $order->status = 'approved';
        $order->save();

        return back()->with('success', 'Order berhasil diapprove');
    }

}