<?php

use App\Http\Controllers\Back\BookController;
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

Route::prefix("/")->group(function() {

    //  route untuk HOME
    Route::controller(HomeController::class)->group(function() {
        Route::get("/", "index");
        Route::get("/{id}", "detail");
    });

});

Route::prefix("/")->group(function() {

    // Route::get("/", function() {
    //     return view("pages.index", [
    //         "books" => Books::all(),
    //         "student" => Students::all(),
    //         "loan" => LogBookLoan::all(),
    //     ]);
    // })->name("admin");

    // Route::prefix("/book")->group(function () {

        Route::controller(BookController::class)->group(function () {
            Route::get("/", "index")->name("book");
            Route::post("/", "create")->name("book.create");
            Route::put("/{id}/update", "update")->name("book.update");
            Route::delete("/delete/{id}", "delete")->name("book.delete");
        });

    // });

});
