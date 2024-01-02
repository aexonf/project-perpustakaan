<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required|string",
            "password" => "required",
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {

            // status
            $librarian = Librarian::where("user_id", Auth::user()->id)->first();

            if (Auth::user()->role === "admin" || ($librarian && $librarian->status === "active")) {
                return redirect('/admin')->with('success', 'Masuk berhasil!');
            }
            if ($librarian && $librarian->status === "inactive") {
                return Inertia::render("Login", ["message" => "Akun anda tidak aktif"]);
            }

            Auth::logout();
            return redirect('/');
        }

        return Inertia::render("Login", ["message" => "Akun atau kata sandi tidak ditemukan"]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
