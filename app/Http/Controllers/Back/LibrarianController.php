<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Librarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LibrarianController extends Controller
{

    public function index(Request $request)
    {

        $statusQuery = $request->query("status");

        // query ke database
        $librarian = Librarian::query();

        // check query parameters
        if ($request->has("status")) {
            $librarian->where("status", $statusQuery);
        }


        // Menggunakan nullish coalescing untuk memberikan nilai default
        $librarians = $librarian->get() ?? Librarian::all();

        // check users
        $librarianUserCheck = Librarian::pluck("user_id")->toArray();

        $users = User::whereNotIn("id", $librarianUserCheck)->get();


        return view("pages.librarian.index", [
            "librarians" => $librarians,
            "request" => $request,
            "users" => $users
        ]);
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            "name" => "string|required",
            "user_id" => "required"
        ]);

        $librarianCreate = Librarian::create([
            "name" => $validasi["name"],
            "user_id" => $validasi["user_id"],
            "status" => "active"
        ]);

        // jika berhasil membuat penjaga
        if ($librarianCreate) {
            Session::flash("success", "Berhasil membuat penjaga");
            return redirect()->back();
        }
        // jika gagal membuat penjaga
        Session::flash("error", "Gagal membuat penjaga");
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $findLibrarian = Librarian::find($id);

        $update =  $findLibrarian->update([
            "name" => $request->name,
            "user_id" => $request->user_id,
            "status" => $request->status ?? "active"
        ]);

        // jika berhasil memperbarui penjaga
        if ($update) {
            Session::flash("success", "Berhasil memperbarui penjaga");
            return redirect()->back();
        }
        // jika gagal memperbarui penjaga
        Session::flash("error", "Gagal memperbarui penjaga");
        return redirect()->back();
    }


    public function delete($id)
    {
        $findLibrarian = Librarian::find($id);

        $delete =  $findLibrarian->delete();

        // jika berhasil menghapus penjaga
        if ($delete) {
            Session::flash("success", "Berhasil menghapus penjaga");
            return redirect()->back();
        }
        // jika gagal menghapus penjaga
        Session::flash("error", "Gagal menghapus penjaga");
        return redirect()->back();
    }
}
