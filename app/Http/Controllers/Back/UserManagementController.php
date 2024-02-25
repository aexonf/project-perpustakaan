<?php

namespace App\Http\Controllers\Back;

use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Imports\TeacherImport;
use App\Imports\TeamplateStudentImport;
use App\Imports\TeamplateTeacherImport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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
            "id_number" => "required",
            "name" => "required",
            "phone_number" => "required",
        ]);

        $student = User::create([
            "name" => $validasi["name"],
            "id_number" => $validasi["id_number"],
            "role" => "student",
            "phone_number" => $validasi["phone_number"],
            "status" => "active",
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
            "id_number" => $request->id_number,
            "phone_number" => $request->phone_number,
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

    public function exportStudent()
    {
        return Excel::download(new StudentExport, "siswa.xlsx");
    }


    // crud guru
    public function exportTeacher()
    {
        return Excel::download(new TeacherExport, "guru.xlsx");
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
            "id_number" => "required",
            "name" => "required",
            "phone_number" => "required",
        ]);

        $teacher = User::create([
            "name" => $validasi["name"],
            "id_number" => $validasi["id_number"],
            "role" => "teacher",
            "phone_number" => $validasi["phone_number"],
            "status" => "active",
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
            "id_number" => $request->id_number,
            "phone_number" => $request->phone_number,
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

    public function exportPdfLibrarian()
    {
        $pdf = Pdf::loadView('pages.librarian.format-export', ["data" => User::where("role", "librarian")->get()]);
        return $pdf->download('Siswa.pdf');
    }

    public function librarianIndexs()
    {
        return view("pages.librarian.index", [
            "librarians" => User::where("role", "librarian")->get()
        ]);
    }

    public function librarianCreate(Request $request)
    {
        dd($request->all());

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/user/', $file_name);
            $imageName = $file_name;
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
            "password" => Hash::make($request->password),
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
        $user = User::find($id);
        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = Str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/user/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = $user->image;
        }

        $librarian = $user->update([
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


    public function downloadTemplateStudent()
    {
        return Excel::download(new TeamplateStudentImport, 'siswa.xlsx');
    }


    public function downloadTemplateTeacher()
    {
        return Excel::download(new TeamplateTeacherImport, 'guru.xlsx');
    }


    public function importStudent()
    {
        try {
            Excel::import(new StudentImport, request()->file('student'));
            return redirect()->route('book')->with('success', 'Data Siswa berhasil diimport!');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->route('book')->with('error', "Data Siswa gagal diimport!");
        }
    }

    public function importTeacher()
    {
        try {
            Excel::import(new TeacherImport, request()->file('teacher'));
            return redirect()->route('book')->with('success', 'Data Guru berhasil diimport!');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->route('book')->with('error', "Data Guru gagal diimport!");
        }
    }

}
