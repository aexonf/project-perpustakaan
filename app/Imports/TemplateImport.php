<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TemplateImport implements FromView
{

    public function view(): View
    {
        return view("pages.book.format-import");
    }
}
