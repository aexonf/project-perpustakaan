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

        // Get the librarians collection
        $librarians = $librarian->get();

        // Check if the collection is empty
        if (empty($librarians)) {
            // If empty, fallback to fetching all records
            $librarians = Librarian::all();
        }

        // check users
        $librarianUserCheck = Librarian::pluck("user_id")->toArray();

        $users = User::whereNotIn("id", $librarianUserCheck)
            ->where("role", "!=", "student")
            ->where("role", "!=", "admin")
            ->get();

        return view("pages.librarian.index", [
            "librarians" => $librarians,
            "request" => $request,
            "users" => $users
        ]);
    }


    public function create(Request $request)
    {
        $validasi = $request->validate([
            "user_id" => "required"
        ]);

        $librarianCreate = Librarian::create([
            "name" => User::find($validasi["user_id"])->username,
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

        $update = $findLibrarian->update([
            "user_id" => $request->user_id,
            "status" => $request->status ?? "active",
            "name" => User::find($request->user_id)->username,
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

        $delete = $findLibrarian->delete();

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
