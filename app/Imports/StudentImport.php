<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        if ($row[0] == 'Nama' && $row[1] == 'Nomer Id' && $row[2] == 'Nomer Telpon') {
            return null;
        }

        return User::create([
            "name" => $row[0],
            "id_number" => $row[1],
            "phone_number" => $row[2],
            "role" => "student",
            "status" => "active",
        ]);
    }
}
