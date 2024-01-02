<?php

namespace App\Http\Middleware;

use App\Models\Librarian;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LibrarianMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $librarian = Librarian::where("user_id", Auth::user()->id)->first();

        if(!$librarian){
            return abort(403);
        }
        return $next($request);
    }
}
