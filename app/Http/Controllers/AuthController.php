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

            if (Auth::user()->role === "admin" || Auth::user()->role === "librarian") {
                return redirect('/admin')->with('success', 'Masuk berhasil!');
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
