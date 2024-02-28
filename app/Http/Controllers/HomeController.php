<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    // detail buku
    public function index(Request $request)
    {
       $bookQuery = Books::query();

        // search by book title
        $titleSearch = $request->query("title");
        $categorySearch = $request->query("category");

        // search by title
        if ($request->has("title")) {
            $bookQuery->where("series_title", "like", "%" . $titleSearch . "%")->get();
        }
        // search by category
        if ($request->has("category")) {
            $bookQuery->where("category", "like", "%" . $categorySearch . "%")->get();
        }

        $book = $bookQuery->paginate(10);
        $bookLatest = $bookQuery->latest()->paginate(10);
        $category = $bookQuery->orderBy('created_at', 'desc')->take(5)->pluck('category');
        if ($request->query("title") || $request->query("category")) {
            return Inertia::render("Find", [
                "data" => $bookQuery->paginate(10),
            ]);
        }

        $popularBook = Books::orderBy('loan_count', 'desc')->get();
        return Inertia::render("Home", [
            "data" => $book,
            "bookLatest" => $bookLatest,
            "category" => $category,
            "popular" => $popularBook
        ]);
    }


    public function detail($id, Request $request)
    {
        return Inertia::render("Detail", [
            "book" => Books::find($id),
        ]);
    }
}
