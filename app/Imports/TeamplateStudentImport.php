<?php

namespace App\Imports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeamplateStudentImport implements FromView
{
    public function view(): View
    {
        return view("pages.student.format-import");
    }
}
