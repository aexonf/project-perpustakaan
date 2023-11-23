<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // mendapatkan value dari query search
        $bookQueryTitle = $request->query("search");
        // mendapatkan value dari query status
        $bookQueryStatus = $request->query("status");

        // query ke database
        $books = Books::query();

        if ($request->has('search')) {
            $books->where("title", 'LIKE', "%$bookQueryTitle%");
        } else if ($request->has('status')) {
            $books->where("status", 'LIKE', "%$bookQueryStatus%");
        }

        // Menggunakan nullish coalescing untuk memberikan nilai default
        $books = $books->get() ?? Books::all();

        return view("pages.book.index", [
            "books" => $books,
        ]);
    }

    public function create(Request $request)
    {
        // validasi request
        $validasi = $request->validate([
            "title" => "required",
            "no_inventory" => "required|integer",
            "genre" => "required",
            "writer" => "required",
            "status" => "required",
            "tahun" => "required",
            "stock" => "required|integer",
            "location" => "required",
        ]);


        // create buku
        $createBook = Books::create([
            "title" => $validasi["title"],
            "genre" => $validasi["genre"],
            "writer" => $validasi["writer"],
            "status" => $validasi["status"],
            "year" => $validasi["tahun"],
            "stock" => $validasi["stock"],
            "location" => $validasi["location"],
            "no_inventory" => $validasi["no_inventory"],
        ]);


        // cek jika create buku berhasil
        if ($createBook) {
            Session::flash("success", "Buku berhasil di buat");
            return redirect()->back();
        }

        // jika buku gagal di buat
        Session::flash("error", "Data buku gagal masuk ke database");
        return redirect()->back();
    }

    public function update($id, Request $request){

        $updateBook = Books::find($id)->update([
            "title" => $request->title,
            "genre" =>  $request->genre,
            "writer" =>  $request->writer,
            "status" =>  $request->status,
            "year" =>  $request->tahun,
            "stock" =>  $request->stock,
            "location" =>  $request->location,
            "no_inventory" =>  $request->no_inventory,
        ]);

        // jika buku berhasil di update
        if ($updateBook) {
            Session::flash("success", "Buku berhasil di update");
            return redirect()->back();
        }

        // jika buku gagal di update
        Session::flash("error", "Buku gagal di update");
        return redirect()->back();


    }


    public function delete($id)
    {
        // mencari buku dan di hapus
        $deleteBook = Books::find($id)->delete();

        // jika buku berhasil di hapus
        if ($deleteBook) {
            Session::flash("success", "Buku berhasil di hapus");
            return redirect()->back();
        }

        // jika buku gagal di hapus
        Session::flash("error", "Buku gagal di hapus");
        return redirect()->back();
    }
}
