<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserManagementController extends Controller
{
    public function studentIndex(Request $request)
    {
        return view("pages.student.index", [
            "student" => User::where("role", "student")->get()
        ]);
    }

    public function studentCreate(Request $request)
    {
        $validasi = $request->validate([
            "name" => "required",
            "email" => "required",
        ]);

        $student = User::create([
            "name" => $validasi["name"],
            "email" => $validasi["email"],
            "role" => "student",
            "password" => Hash::make("password"),
            "status" => $request->status,
        ]);


        // cek jika create buku berhasil
        if ($student) {
            Session::flash("success", "Siswa berhasil di buat");
            return redirect()->back();
        }

        // jika buku gagal di buat
        Session::flash("error", "Data siswa gagal masuk ke database");
        return redirect()->back();
    }

    public function studentEdit(Request $request, $id)
    {
        $student = User::find($id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "role" => "student",
            "password" => Hash::make($request->password),
            "status" => $request->status,
        ]);

        if ($student) {
            Session::flash("success", "Siswa berhasil di update");
            return redirect()->back();
        }

        Session::flash("error", "Data siswa gagal update");
        return redirect()->back();
    }


    public function studentDelete($id)
    {
        $student = User::find($id)->delete();

        if ($student) {
            Session::flash("success", "Siswa berhasil di hapus");
            return redirect()->back();
        }

        Session::flash("error", "Data siswa gagal di hapus");
        return redirect()->back();
    }
}
