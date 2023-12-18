<?php

namespace App\Providers;

use App\Models\ActiveStudents;
use App\Models\Books;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer("*", function($view){
            $view->with('genre', Books::all()->pluck("genre")->unique());
            $view->with("class", ActiveStudents::all()->pluck("class")->unique());
            $view->with('school_years', collect([
                '2020/2021', '2021/2022', '2022/2023', '2023/2024', '2024/2025',
                '2025/2026', '2026/2027', '2027/2028', '2028/2029', '2029/2030',
                '2030/2031', '2031/2032', '2032/2033', '2033/2034', '2034/2035'
            ]));
            $view->with('generations', collect([
                'X', 'XI', 'XII'
            ]));
        });
    }
}
