<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Back\BookController;
use App\Http\Controllers\Back\LoanController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Back\UserManagementController;
use App\Http\Controllers\HomeController;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::controller(AuthController::class)->group(function () {
    Route::get("/login", "index")->name("login")->middleware("guest");
    Route::post("/login", "login");
    Route::post("/logout", "logout")->name("logout");
});

Route::prefix("/admin")->middleware('librarian')->group(function () {

    Route::get("/", function () {
        return view("pages.index");
    })->name("admin");

    Route::prefix("/buku")->group(function () {

        Route::controller(BookController::class)->group(function () {
            Route::get("/", "index")->name("book");
            Route::post("/", "create")->name("book.create");
            Route::put("/{id}/update", "update")->name("book.update");
            Route::delete("/delete/{id}", "delete")->name("book.delete");
            Route::get("/download-template", "downloadTemplate")->name("book.download.template");
            Route::post("/import", "import")->name("book.import");
            Route::get("/export", "export")->name("book.export");
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

    Route::prefix("/user/management")->group(function () {

        Route::controller(UserManagementController::class)->group(function () {
            // CRUD for students
            Route::get("/student", "studentIndex")->name("student.management");
            Route::post("/student", "studentCreate")->name("student.create");
            Route::put("/edit/student/{id}", "studentEdit")->name("student.edit");
            Route::delete("/delete/student/{id}", "studentDelete")->name("student.delete");
            Route::get("/student/export", "exportPdfStudent")->name("student.export");

            // CRUD for teachers
            Route::get("/teacher", "teacherIndex")->name("teacher.management");
            Route::post("/teacher", "teacherCreate")->name("teacher.create");
            Route::put("/edit/teacher/{id}", "teacherEdit")->name("teacher.edit");
            Route::delete("/delete/teacher/{id}", "teacherDelete")->name("teacher.delete");
            Route::post("/teacher/export", "exportPdfTeacher")->name("teacher.export");

            // CRUD for librarians
            Route::get("/librarian", "librarianIndex")->name("librarian.management");
            Route::post("/librarian", "librarianCreate")->name("librarian.create");
            Route::put("/edit/librarian/{id}", "librarianEdit")->name("librarian.edit");
            Route::delete("/delete/librarian/{id}", "librarianDelete")->name("librarian.delete");
            Route::get("/librarian", "exportPdfLibrarian")->name("librarian.export");
        });
    });


    Route::controller(SettingController::class)->group(function() {

        Route::get("/setting", "index")->name("admin.setting");
        Route::put("/setting", "store")->name("admin.setting.store");
    });




});

Route::controller(HomeController::class)->group(function () {
    Route::get("/", "index")->name("home");
    Route::get("/detail/{id}", "detail")->name("book.detail");
});

Route::get("/pustakawan", function () {
    return Inertia::render("Pustakawan/Pustakawan", [
        "data" => User::where("role", "librarian")->get(),
    ]);
});

Route::get("/informasi", function () {

 return Inertia::render("Informasi/Informasi", [
    "data" => Setting::first()
 ]);

});
