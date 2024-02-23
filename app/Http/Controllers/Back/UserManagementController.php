<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


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

    public function exportPdfStudent(){
        $pdf = Pdf::loadView('pages.student.format-export', ["data" => User::where("role","student")->get() ]);
        return $pdf->download('Siswa.pdf');
    }


    // crud guru
    public function exportPdfTeacher(){
        $pdf = Pdf::loadView('pages.teacher.format-export', ["data" => User::where("role","teacher")->get() ]);
        return $pdf->download('Siswa.pdf');
    }

    public function teacherIndex()
    {
        return view("pages.teacher.index", [
            "teacher" => User::where("role", "teacher")->get()
        ]);
    }

    public function teacherCreate(Request $request)
    {
        $validasi = $request->validate([
            "name" => "required",
            "email" => "required",
        ]);

        $teacher = User::create([
            "name" => $validasi["name"],
            "email" => $validasi["email"],
            "role" => "teacher",
            "password" => Hash::make("password"),
            "status" => $request->status,
        ]);

        // Check if teacher creation was successful
        if ($teacher) {
            Session::flash("success", "Guru berhasil dibuat");
            return redirect()->back();
        }

        // If teacher creation failed
        Session::flash("error", "Data guru gagal dimasukkan ke database");
        return redirect()->back();
    }

    public function teacherEdit(Request $request, $id)
    {
        $teacher = User::find($id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "role" => "teacher",
            "password" => Hash::make($request->password),
            "status" => $request->status,
        ]);

        if ($teacher) {
            Session::flash("success", "Guru berhasil diupdate");
            return redirect()->back();
        }

        Session::flash("error", "Data guru gagal diupdate");
        return redirect()->back();
    }

    public function teacherDelete($id)
    {
        $teacher = User::find($id)->delete();

        if ($teacher) {
            Session::flash("success", "Guru berhasil dihapus");
            return redirect()->back();
        }

        Session::flash("error", "Data guru gagal dihapus");
        return redirect()->back();
    }


    // crud librarian

    public function exportPdfLibrarian(){
        $pdf = Pdf::loadView('pages.librarian.format-export', ["data" => User::where("role","librarian")->get() ]);
        return $pdf->download('Siswa.pdf');
    }

    public function librarianIndex()
    {
        return view("pages.librarian.index", [
            "librarians" => User::where("role", "librarian")->get()
        ]);
    }

    public function librarianCreate(Request $request)
    {

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/user/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = "";
        }


        $validasi = $request->validate([
            "name" => "required",
            "email" => "required",
        ]);

        $librarian = User::create([
            "name" => $validasi["name"],
            "email" => $validasi["email"],
            "role" => "librarian",
            "image" => $imageName,
            "password" => Hash::make("password"),
            "status" => $request->status,
        ]);

        // Check if librarian creation was successful
        if ($librarian) {
            Session::flash("success", "Pustakawan berhasil dibuat");
            return redirect()->back();
        }

        // If librarian creation failed
        Session::flash("error", "Data pustakawan gagal dimasukkan ke database");
        return redirect()->back();
    }

    public function librarianEdit(Request $request, $id)
    {

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/user/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = "";
        }


        $librarian = User::find($id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "role" => "librarian",
            "image" => $imageName,
            "password" => Hash::make($request->password),
            "status" => $request->status,
        ]);

        if ($librarian) {
            Session::flash("success", "Pustakawan berhasil diupdate");
            return redirect()->back();
        }

        Session::flash("error", "Data pustakawan gagal diupdate");
        return redirect()->back();
    }

    public function librarianDelete($id)
    {
        $librarian = User::find($id)->delete();

        if ($librarian) {
            Session::flash("success", "Pustakawan berhasil dihapus");
            return redirect()->back();
        }

        Session::flash("error", "Data pustakawan gagal dihapus");
        return redirect()->back();
    }
}
