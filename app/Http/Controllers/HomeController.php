<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data film terbaru, 6 per halaman
        $movies = Movie::latest()->paginate(6);

        // Kirim ke view 'home.blade.php' dengan variabel $movies
        return view('home', compact('movies'));
    }
}
