<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.categori', compact('categories'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan data kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Tampilkan form untuk edit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Simpan perubahan pada data kategori.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $moviesCount = Movie::where('category_id', $category->id)->count();

        if ($moviesCount > 0) {
            return redirect()->route('category.index')->with('error', 'Kategori ini tidak dapat dihapus karena masih digunakan oleh ' . $moviesCount . ' film.');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
