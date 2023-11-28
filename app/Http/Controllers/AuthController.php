<?php

namespace App\Http\Controllers;

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
        // Validasi data yang diterima dari request
        $credentials = $request->validate([
            "username" => "required|string",
            "password" => "required",
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == "librarian") {
                return redirect('/admin')->with('success', 'Masuk berhasil!');
            }
            return redirect('/');
        }

        return Inertia::render("Login", ["message" => "Akun atau kata sandi tidak ditemukan"]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
