<?php

namespace App\Imports;

use App\Models\Books;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{

    public function model(array $row)
    {
     if ($row[0] == 'Nomer Inventory' && $row[1] == 'Judul' && $row[2] == 'Penulis' && $row[3] == 'Genre' && $row[4] == 'Tahun' && $row[5] == 'Stock' && $row[6] == 'Location' && $row[7] == 'Status') {
        return null;
    }

    return Books::create([
        "no_inventory" => $row[0],
        "title" => $row[1],
        "writer" => $row[2],
        "genre" => $row[3],
        "year" => $row[4],
        "stock" => $row[5],
        "location" => $row[6],
        "status" => $row[7],
    ]);
    }
}
