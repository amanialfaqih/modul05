<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search judul
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(5)->withQueryString();
        $categories = Category::all();

        $totalBooks = Book::count();
        $totalCategories = Category::count();

        return view('books.index', compact(
            'books',
            'categories',
            'totalBooks',
            'totalCategories'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'category_id' => 'required'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
                ->with('success','Book berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book','categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'category_id' => 'required'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
                ->with('success','Book berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                ->with('success','Book berhasil dihapus');
    }
}