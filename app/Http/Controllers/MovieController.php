<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function homepage()
    {
        $movies = Movie::latest()->paginate(10);
        return view('layouts.home', compact('movies'));
    }

    public function detail($id, $slug)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.detailmovie', compact('movie'));
    }

    public function index()
    {
        $movies = Movie::latest()->paginate(10);
        return view('movies.movie', compact('movies'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->title);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1950|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $cover = null;
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image')->store('covers', 'public');
        }

        Movie::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'synopsis' => $validated['synopsis'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'cover_image' => $cover,
        ]);

        return redirect('home')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug,' . $movie->id,
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1950|max:' . date('Y'),
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Buat slug baru dari title
        $validated['slug'] = Str::slug($validated['title']);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
                Storage::disk('public')->delete($movie->cover_image);
            }

            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        } else {
            // Jika tidak upload file baru, tetap simpan gambar lama
            $validated['cover_image'] = $movie->cover_image;
        }

        $movie->update($validated);

        return redirect()->route('movie.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        // Hapus gambar jika ada
        if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
            Storage::disk('public')->delete($movie->cover_image);
        }

        $movie->delete();

        return redirect()->route('movie.index')->with('success', 'Movie deleted successfully.');
    }
}
