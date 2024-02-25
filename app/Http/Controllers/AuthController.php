<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render("Login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "name" => "required|string",
            "password" => "required",
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if (Auth::user()->role === "librarian" && ($user && $user->status === "active")) {
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
