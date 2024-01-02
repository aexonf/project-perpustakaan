<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Back\BookController;
use App\Http\Controllers\Back\LibrarianController;
use App\Http\Controllers\Back\LoanController;
use App\Http\Controllers\HomeController;
use App\Models\Books;
use App\Models\LogBookLoan;
use App\Models\Students;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(HomeController::class)->group(function () {
    Route::get("/", "index");
    Route::get("/{id}/detail", "detail");
});

Route::controller(AuthController::class)->group(function () {
    Route::get("/login", "index")->name("login")->middleware("guest");
    Route::post("/login", "login");
    Route::post("/logout", "logout")->name("logout");
});



Route::prefix("/admin")->middleware('auth')->group(function () {

    Route::get("/", function () {
        return view("pages.index", [
            "books" => Books::all(),
            "student" => Students::all(),
            "loan" => LogBookLoan::all(),
        ]);
    })->name("admin");

    Route::prefix("/buku")->group(function () {

        Route::controller(BookController::class)->group(function () {
            Route::get("/", "index")->name("book");
            Route::post("/", "create")->name("book.create");
            Route::put("/{id}/update", "update")->name("book.update");
            Route::delete("/delete/{id}", "delete")->name("book.delete");
            Route::get("/download-template", "downloadTemplate")->name("book.download.template");
            Route::post("/import", "import")->name("book.import");
        });
    });

    Route::prefix("/pinjaman")->group(function () {

        Route::controller(LoanController::class)->group(function () {
            Route::get("/", "index")->name("loan");
            Route::get("/{id}/detail", "detail")->name("loan.detail");
            Route::put("/{id}/kemabali", "returnedBook")->name("loan.returned");
            Route::put("/{id}/returned/kembali-semua", "returnedAllBook")->name("loan.returned.all");
            Route::post("/{id}/tambah-pinjam", "loan")->name("loan.book");
            Route::get("/tambah", "storeView")->name("tambah.book.index");
            Route::post("/tambah", "loanIndex")->name("tambah.book.loan");
            // Route::delete("/delete/{id}", "delete")->name("loan.delete");
        });
    });

    Route::prefix("/penjaga")->group(function () {

        Route::controller(LibrarianController::class)->group(function () {
            Route::get("/", "index")->name("penjaga");
            Route::post("/", "create")->name("penjaga.create");
            Route::put("/{id}/update", "update")->name("penjaga.update");
            Route::delete("/delete/{id}", "delete")->name("penjaga.delete");
            Route::get("/download-template", "downloadTemplate")->name("penjaga.download.template");
            Route::post("/import", "import")->name("penjaga.import");
        });
    });
});
