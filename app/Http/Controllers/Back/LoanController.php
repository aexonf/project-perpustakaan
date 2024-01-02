<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ActiveStudents;
use App\Models\Books;
use App\Models\Librarian;
use App\Models\LogBookLoan;
use App\Models\Settings;
use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /**
         * Get the view for displaying the index page of book loans.
         *
         * @param void
         * @return \Illuminate\View\View
         */

        $activeStudent = ActiveStudents::with('student');
        $peminjam = LogBookLoan::query();

        if ($request->has("class")) {
            $activeStudent->where("class", $request->query("class"));
        }

        if($request->has("status")) {
            $peminjam->where("status", $request->query("status"));
        }

        $activeStudentResults = $activeStudent->get();
        $peminjamResults = $peminjam->get();

        return view("pages.loan.index", [
            "loan" => $peminjamResults,
            "books" => Books::where("status", "available")->get(),
            "students" => $activeStudentResults,
        ]);
    }


    public function storeView(Request $request){
       return view("pages.loan.add-loan", [
           "request" => $request,
           "angkatan" => ActiveStudents::where("school_year", $request->school_year)->pluck("generation")->unique(),
           "kelas" => ActiveStudents::where("school_year", $request->school_year)->where("generation", $request->generation)->pluck("class")->unique(),
           "students" => ActiveStudents::where("school_year", $request->school_year)->where("generation", $request->generation)->where("class", $request->class)->get(),
           "books" => Books::all(),
           "setting" => Settings::first()
       ]);
    }


    /**
     * create loan book
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Session::flash()
     */
    public function loanIndex(Request $request)
    {
        /**
         * Create a new book loan record for a student.
         *
         * @param int $id Student ID
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        $loan = LogBookLoan::create([
            "student_id" => $request->student,
            "book_id" => $request->book,
            "librarian_id" => Librarian::where("user_id", Auth::user()->id)->first(),
            "loan_date" => Carbon::now(),
            "return_date" => "",
        ]);

        // jika peminjaman berhasil
        if ($loan) {
            Session::flash("success", "Berhasil meminjam buku");
            return redirect()->back();
        }
        // jika gagal meminjam
        Session::flash("error", "Gagal meminjam buku");
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        /**
         * Get the view for displaying the detailed information of a student's book loans.
         *
         * @param int $id Student ID
         * @return \Illuminate\View\View
         */

         $studentId = LogBookLoan::find($id);
        return view("pages.loan.detail", [
            "student" => Students::find($studentId->student_id),
            "loan" => LogBookLoan::where("student_id", $studentId->student_id)->get(),
            "book" => Books::where("status", "available")->get(),
        ]);
    }

    /**
     * Mark all books as returned for a specific student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function returnedAllBook($id)
    {
        /**
         * Mark all books as returned for a specific student.
         *
         * @param int $id Student ID
         * @return \Illuminate\Http\RedirectResponse
         */
        $returned = LogBookLoan::where("student_id", $id)->where("status", "pending")->get();
        foreach($returned as $value){
            $value->update([
                "status" => "returned",
                "return_date" => Carbon::now("Asia/Jakarta"),
            ]);
        }

        if ($returned) {
            Session::flash("success", "Berhasil mengembalikan semua buku");
            return redirect()->back();
        }

        //    jika buku gagal di update
        Session::flash("error", "Gagal mengembalikan semua buku");
        return redirect()->back();
    }


    /**
     * Mark a specific book as returned.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function returnedBook($id)
    {
        /**
         * Mark a specific book as returned.
         *
         * @param int $id Log Book Loan ID
         * @return \Illuminate\Http\RedirectResponse
         */
        $returned = LogBookLoan::find($id);
        $returned->update([
            "status" => "returned",
            "return_date" => Carbon::now("Asia/Jakarta"),
        ]);

        //    jika buku berhasil di update
        if ($returned) {
            Session::flash("success", "Buku berhasil di kembalikan");
            return redirect()->back();
        }

        //    jika buku gagal di update
        Session::flash("error", "Buku gagal di kembalikan");
        return redirect()->back();
    }

    /**
     * Create a new book loan record for a student.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loan($id, Request $request)
    {
        /**
         * Create a new book loan record for a student.
         *
         * @param int $id Student ID
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        $loan = LogBookLoan::create([
            "student_id" => $id,
            "book_id" => $request->book,
            "librarian_id" => Auth::user()->id,
            "loan_date" => Carbon::now(),
            "return_date" => "",
        ]);

        // jika peminjaman berhasil
        if ($loan) {
            Session::flash("success", "Berhasil meminjam buku");
            return redirect()->back();
        }
        // jika gagal meminjam
        Session::flash("error", "Gagal meminjam buku");
        return redirect()->back();
    }
}
