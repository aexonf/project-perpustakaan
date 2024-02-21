<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // detail buku


    public function index(Request $request)
    {

        $bookQuery = Books::query();

        // search by author
        // search by book title
        $authorSearch = $request->query("author");
        $titleSearch = $request->query("title");

        // search by author
        if ($request->has("author")) {
            $bookQuery->where("", "like", "%" . $authorSearch . "%");
        }

        // search by title
        if ($request->has("title")) {
            $bookQuery->where("title", "like", "%" . $titleSearch . "%");
        }


        $book = $bookQuery->get();
        $bookLatest = $bookQuery->latest();
        $category = $bookQuery->pluck("category");

        return view("home", [
            "data" => $book,
            "bookLatest" => $bookLatest,
            "category" => $category
        ]);
    }

    public function detail($id, Request $request)
    {
        return view("detail", [
            "book" => Books::find($id)
        ]);
    }
}
