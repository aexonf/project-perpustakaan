<?php

namespace App\Http\Controllers\Back;

use App\Exports\BookExport;
use App\Http\Controllers\Controller;
use App\Imports\BookImport;
use App\Imports\TemplateImport;
use App\Models\Books;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;


class BookController extends Controller
{
    public function index(Request $request)
    {
        // mendapatkan value dari query search
        $bookQueryTitle = $request->query("search");
        // mendapatkan value dari query status
        $bookQueryStatus = $request->query("status");
        // mendapatkan value dari query genre
        $bookQueryGenre = $request->query("genre");

        // query ke database
        $books = Books::query();

        if ($request->has('search')) {
            $books->where("title", 'LIKE', "%$bookQueryTitle%");
        } elseif ($request->has('status')) {
            $books->where("status", 'LIKE', "%$bookQueryStatus%");
        } elseif ($request->has("genre")) {
            $books->where("genre", 'LIKE', "%$bookQueryGenre%");
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


        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/book/', $file_name);
            $validasi["image"] = $file_name;
        }else{
            $validasi["image"] = "";
        }

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
            "image" => $validasi["image"],
            "user_id" => 1,
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

    public function update($id, Request $request)
    {

        $updateBook = Books::find($id)->update([
            "title" => $request->title,
            "genre" =>  $request->genre,
            "writer" =>  $request->writer,
            "status" =>  $request->status,
            "year" =>  $request->tahun,
            "stock" =>  $request->stock,
            "location" =>  $request->location,
            "no_inventory" =>  $request->no_inventory,
            "user_id" => 1,
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


    public function downloadTemplate()
    {
        return Excel::download(new TemplateImport, 'template.xlsx');
    }


    public function import()
    {
        try {
            Excel::import(new BookImport, request()->file('book'));
            return redirect()->route('book')->with('success', 'Data Buku berhasil diimport!');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->route('book')->with('error', "Data Buku gagal diimport!");
        }
    }

    public function export()
    {
        $qrCode = QrCode::size(50)->generate("a");
        $pdf = Pdf::loadview('pages.book.format-export',['data'=> Books::all(), "qr" => $qrCode]);
    	return $pdf->download('book.pdf');
     }
}
