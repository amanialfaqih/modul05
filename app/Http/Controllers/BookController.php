<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wishlist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    // =====================
    // ADMIN (CRUD)
    // =====================

    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->search) {
            $query->where('judul','like','%'.$request->search.'%');
        }

        if ($request->category) {
            $query->where('category_id',$request->category);
        }

        $books = $query->paginate(8)->withQueryString();
        $totalBooks = $query->count();
        $categories = Category::all();

        return view('books.index', compact('books','categories','totalBooks'));
    }

    public function create()
    {
        return view('books.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'harga' => 'required|numeric',
            'cover' => 'nullable|image|max:2048'
        ]);

        $namaFile = null;

        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/books'), $namaFile);
        }

        Book::create([
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'cover' => $namaFile
        ]);

        return redirect()->route('books.index')->with('success','Book berhasil ditambahkan');
    }

    // 🔥 INI YANG DITAMBAHKAN (FIX ERROR DETAIL)
    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'harga' => 'required|numeric',
            'cover' => 'nullable|image|max:2048'
        ]);

        $namaFile = $book->cover;

        if($request->hasFile('cover')){
            $file = $request->file('cover');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/books'), $namaFile);
        }

        $book->update([
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'cover' => $namaFile
        ]);

        return redirect()->route('books.index')->with('success','Book berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success','Book berhasil dihapus');
    }

    // =====================
    // 🔥 EXPORT (FIX ERROR)
    // =====================

    public function exportPdf()
    {
        $books = Book::with('category')->get();

        $pdf = Pdf::loadView('books.pdf', compact('books'));

        return $pdf->download('data-buku.pdf');
    }

    public function exportExcel()
    {
        $books = Book::with('category')->get();

        $filename = "data-buku.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($books) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Judul','Kategori','Penulis','Tahun','Stok','Harga']);

            foreach ($books as $book) {
                fputcsv($file, [
                    $book->judul,
                    $book->category->nama_kategori ?? '-',
                    $book->penulis,
                    $book->tahun_terbit,
                    $book->stok,
                    $book->harga
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =====================
    // USER (SHOP)
    // =====================

    public function shop()
    {
        $books = Book::with('category')->paginate(8);

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->pluck('book_id')
            ->toArray();

        return view('user.shop', compact('books','wishlist'));
    }

    public function addToCart($id)
    {
        $book = Book::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "judul" => $book->judul,
                "harga" => $book->harga,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success','Masuk keranjang');
    }

    public function cart()
    {
        return view('user.cart', [
            'cart' => session()->get('cart', [])
        ]);
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success','Item dihapus');
    }

    // =====================
    // CHECKOUT
    // =====================

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if(empty($cart)){
            return back()->with('error','Keranjang kosong');
        }

        $total = collect($cart)->sum(fn($i) => $i['harga'] * $i['qty']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'success'
        ]);

        foreach($cart as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'judul' => $item['judul'],
                'harga' => $item['harga'],
                'qty' => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders')->with('success','Checkout berhasil!');
    }

    // =====================
    // ❤️ WISHLIST
    // =====================

    public function addWishlist($id)
    {
        $check = Wishlist::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->first();

        if($check){
            $check->delete();
            return back()->with('success','Dihapus dari wishlist 💔');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'book_id' => $id
        ]);

        return back()->with('success','Masuk wishlist ❤️');
    }

    public function wishlist()
    {
        $data = Wishlist::with('book')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.wishlist', compact('data'));
    }

    public function removeWishlist($id)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->delete();

        return back()->with('success','Dihapus dari wishlist');
    }

    // =====================
    // ⚙️ SETTINGS
    // =====================

    public function settings()
    {
        return view('user.settings', [
            'user' => auth()->user()
        ]);
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:5',
            'photo' => 'nullable|image|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->hasFile('photo')){

            if($user->photo && File::exists(public_path('images/profile/'.$user->photo))){
                File::delete(public_path('images/profile/'.$user->photo));
            }

            $file = $request->file('photo');
            $nama = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/profile'), $nama);

            $user->photo = $nama;
        }

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success','Profil berhasil diupdate ✅');
    }

    // =====================
    // INVOICE
    // =====================

    public function invoicePdf()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(fn($i) => $i['harga'] * $i['qty']);

        $pdf = Pdf::loadView('user.invoice', [
            'cart' => $cart,
            'total' => $total,
            'date' => now()->format('d M Y H:i'),
            'invoiceNumber' => 'INV-' . date('Ymd-His'),
            'customer' => [
                'name' => auth()->user()->name ?? 'Guest',
                'email' => auth()->user()->email ?? '-',
            ]
        ]);

        return $pdf->download('invoice-amani.pdf');
    }
}