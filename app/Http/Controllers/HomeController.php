<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    // function untuk home index
    public function index(Request $request)
    {

        // mendapatkan value dari query book
        $type = $request->query('type');
        $search = $request->query('search');

        // mengambil data buku yang terbaru
        $booksLatest = Books::latest()->limit(4)->get();

        // query ke tabel books
        $books = Books::query();

        // mengecek apakah ada request query dari book
        if ($search) {
            if ($type == 'title') {
                $books = $books->where('title', 'like', '%' . $search . '%');
            } elseif ($type == "genre") {
                $books = $books->where('genre', 'like', '%' . $search . '%');
            } elseif ($type == "year") {
                $books = $books->where('year', 'like', '%' . $search . '%');
            } elseif ($type == "location") {
                $books = $books->where('location', 'like', '%' . $search . '%');
            } else {
                $books = $books->where('title', 'like', '%' . $search . '%');
            }
        }

        $books = $books->paginate(3);
        return Inertia::render('Home/Home', [
            'books' => $books,
            'latestBooks' => $booksLatest,
        ]);
    }


    // function ini untuk melihat detail buku
    public function detail($id)
    {
        $book = Books::find($id);
    }
}
