<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ActiveStudents;
use App\Models\Books;
use App\Models\Librarian;
use App\Models\LogBookLoan;
use App\Models\Settings;
use App\Models\Students;
use App\Models\User;
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

        $peminjam = LogBookLoan::query();

        if ($request->has("status")) {
            $peminjam->where("status", $request->query("status"));
        }

        $peminjamResults = $peminjam->get()->unique('user_id');

        return view("pages.loan.index", [
            "loan" => $peminjamResults,
            "books" => Books::where("status", "available")->get(),
            "user" => User::distinct()->get()
        ]);
    }


    public function storeView(Request $request)
    {

        // Mengambil tahun sekarang
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;

        // Format tahun dalam format yang diinginkan (misalnya 2023/2024)
        $schoolYear = "$currentYear/$nextYear";

        // Gunakan nilai default jika $request->school_year adalah null
        $schoolYear = $request->school_year ?? $schoolYear;

        // Ambil data angkatan
        // $angkatan = ActiveStudents::where("school_year", $schoolYear)->pluck("generation")->unique();

        return view("pages.loan.add-loan", [
            "user" => User::all(),
            "books" => Books::all(),
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

        $bookId = null;



        foreach ($request->book as $value) {
            $bookId = $value;
            $bookFind = Books::find($bookId);

            if($bookFind->stock == 0) {
                Session::flash("error", "Gagal meminjam buku");
                return redirect()->back();
            }

            $bookFind->stock -= 1;

            if ($bookFind->stock <= 0) {
                $bookFind->status = 'blank';
            }

            $bookFind->save();
        }

        $loan = LogBookLoan::create([
            "user_id" => $request->user_id,
            "book_id" => $bookId,
            "loan_date" => $request->loan_date != null ? $request->loan_date : Carbon::now(),
            "return_date" => "",
            "bill" => "",
            "loan_end_date" => $request->loan_end_date,
        ]);

        // jika peminjaman berhasil
        if ($loan) {
            Session::flash("success", "Berhasil meminjam buku");
            return redirect("/admin/pinjaman");
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

        $data = LogBookLoan::find($id);
        return view("pages.loan.detail", [
            "user" => User::find($data->user_id),
            "loan" => LogBookLoan::where("user_id", $data->user_id)->get(),
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
        $returned = LogBookLoan::where("user_id", $id)->where("status", "pending")->get();
        foreach ($returned as $value) {
            $value->update([
                "status" => "returned",
                "return_date" => Carbon::now("Asia/Jakarta"),
            ]);

            $book = Books::find($returned->book_id);
            $book->stock += 1;
            $book->save();
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


        $book = Books::find($returned->book_id);
        $book->stock += 1;
        $book->save();


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

        $bookId = null;

        foreach ($request->book as $value) {
            $bookId = $value;
        }
        $loan = LogBookLoan::create([
            "user_id" => $id,
            "book_id" => $bookId,
            "loan_date" => $request->loan_date != null ? $request->loan_date : Carbon::now(),
            "return_date" => "",
            "loan_end_date" => $request->loan_end_date,
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
