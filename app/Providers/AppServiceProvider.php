<?php

namespace App\Providers;

use App\Models\ActiveStudents;
use App\Models\Books;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            "user" => fn() => auth()->user()

        ]);
    }
}
