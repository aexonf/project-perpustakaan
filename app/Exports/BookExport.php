<?php

namespace App\Exports;

use App\Models\Books;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BookExport implements FromView, ShouldAutoSize
{

    public function view(): View
    {
        return view('pages.book.format-export', [
            "data" => Books::all(),
        ]);
    }
}
