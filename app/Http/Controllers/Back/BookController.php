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

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/book/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = "";
        }

        // create buku
        $createBook = Books::create([
            'series_title' => $request->input('series_title'),
            'call_no' => $request->input('call_no'),
            'description' => $request->input('description'),
            'publisher' => $request->input('publisher'),
            'physical_description' => $request->input('physical_description'),
            'language' => $request->input('language'),
            'isbn_issn' => $request->input('isbn_issn'),
            'classification' => $request->input('classification'),
            'category' => $request->input('category'),
            'content_type' => $request->input('content_type'),
            'media_type' => $request->input('media_type'),
            'carrier_type' => $request->input('carrier_type'),
            'edition' => $request->input('edition'),
            'subject' => $request->input('subject'),
            'specific_details_info' => $request->input('specific_details_info'),
            'statement' => $request->input('statement'),
            'responsibility' => $request->input('responsibility'),
            'image' => $imageName,
            'status' => $request->input('status'),
            'stock' => $request->input('stock'),
            'user_id' => auth()->user()->id,
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

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/book/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = "";
        }

        $updateBook = Books::find($id)->update([
            'series_title' => $request->input('series_title'),
            'call_no' => $request->input('call_no'),
            'description' => $request->input('description'),
            'publisher' => $request->input('publisher'),
            'physical_description' => $request->input('physical_description'),
            'language' => $request->input('language'),
            'isbn_issn' => $request->input('isbn_issn'),
            'classification' => $request->input('classification'),
            'contetn_type' => $request->input('content_type'),
            'media_type' => $request->input('media_type'),
            'category' => $request->input('category'),
            'carrier_type' => $request->input('carrier_type'),
            'edition' => $request->input('edition'),
            'subject' => $request->input('subject'),
            'specific_details_info' => $request->input('specific_details_info'),
            'statement' => $request->input('statement'),
            'responsibility' => $request->input('responsibility'),
            'image' => $imageName,
            'status' => $request->input('status'),
            'stock' => $request->input('stock'),
            'user_id' => auth()->user()->id,
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
       return Excel::download(new BookExport, "buku.xlsx");
    }
}
