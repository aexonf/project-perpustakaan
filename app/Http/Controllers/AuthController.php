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
        $credentials = $request->validate([
            "username" => "required|string",
            "password" => "required",
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $userSelected = Auth::user()->librarian;
            if (Auth::user()->role === "admin" || ($userSelected ? $userSelected->status === "active" : null)) {
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
