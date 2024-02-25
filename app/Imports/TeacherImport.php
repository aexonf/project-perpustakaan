<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class TeacherImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if ($row[0] == 'Nama' && $row[1] == 'Email' && $row[2] == 'Password') {
            return null;
        }


        return User::create([
            "name" => $row[0],
            "email" => $row[1],
            "password" => $row[2],
            "role" => "student",
            "status" => "active",
        ]);
    }
}
