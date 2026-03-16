<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->search) {
            $query->where('judul','like','%'.$request->search.'%');
        }

        if ($request->category) {
            $query->where('category_id',$request->category);
        }

        $books = $query->paginate(6);

        $categories = Category::all();

        $totalBooks = Book::count();

        return view('books.index', compact('books','categories','totalBooks'));
    }



    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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
            'cover' => $namaFile
        ]);


        return redirect()->route('books.index')->with('success','Book berhasil ditambahkan');

    }



    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }



    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit', compact('book','categories'));
    }



    public function update(Request $request, Book $book)
    {

        $request->validate([
            'category_id' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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
            'cover' => $namaFile
        ]);


        return redirect()->route('books.index')->with('success','Book berhasil diupdate');

    }



    public function destroy(Book $book)
    {

        $book->delete();

        return redirect()->route('books.index')->with('success','Book berhasil dihapus');

    }

}