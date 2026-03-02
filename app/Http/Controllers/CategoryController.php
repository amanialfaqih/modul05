<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // SEARCH
        if ($request->search) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        // FILTER DROPDOWN
        if ($request->kategori_id) {
            $query->where('id', $request->kategori_id);
        }

        $categories = $query->paginate(5)->withQueryString();
        $totalCategories = Category::count();
        $allCategories = Category::all();

        return view('categories.index', compact(
            'categories',
            'totalCategories',
            'allCategories'
        ));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('categories.index')
                ->with('success','Kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required'
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('categories.index')
                ->with('success','Kategori berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
                ->with('success','Kategori berhasil dihapus');
    }
}