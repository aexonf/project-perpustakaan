<?php

use App\Http\Controllers\Back\BookController;
use App\Http\Controllers\HomeController;
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



Route::prefix("/admin")->group(function () {
    Route::controller(BookController::class)->group(function () {
        Route::get("/", "index")->name("book");
        Route::post("/", "create")->name("book.create");
        Route::put("/{id}/update", "update")->name("book.update");
        Route::delete("/delete/{id}", "delete")->name("book.delete");
    });
});

Route::prefix("/")->group(function () {
    //  route untuk HOME
    Route::controller(HomeController::class)->group(function () {
        Route::get("/", "index");
    });
});