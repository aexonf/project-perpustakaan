<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // function untuk home index
    public function index(Request $request){

        // mendapatkan value dari query book
        $bookQuery = $request->query("book");

        // mengambil data buku yang terbaru
        $booksLatest = Books::latest()->paginate(5);


        // query ke tabel books
        $books = Books::query();

        // mengecek apakah ada request query dari book
        if($bookQuery){
            $books->where("title", 'LIKE', "%$bookQuery%");
        }

        $books = $books->get();

    }

    // function ini untuk melihat detail buku
    public function detail($id){
        $book = Books::find($id);

    }

}
