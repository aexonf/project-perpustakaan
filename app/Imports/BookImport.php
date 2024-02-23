<?php

namespace App\Imports;

use App\Models\Books;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;


class BookImport implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] == 'Judul Seri' && $row[1] == 'No Panggil' && $row[2] == 'Description' && $row[3] == 'Penerbit' && $row[4] == 'Deskripsi Fisik' && $row[5] == 'Bahasa' && $row[6] == 'ISBN/ISSN' && $row[7] == 'klasifikasi' && $row[8] == 'Jenis konten' && $row[9] == 'Tipe Media' && $row[10] == 'Tipe Pembawa' && $row[11] == 'Staock' && $row[12] == 'Edition' && $row[13] == 'Subject' && $row[14] == 'Info Detail Spesifik' && $row[15] == 'Pernyataan' && $row[16] == "Tanggung Jawab" && $row[17] == "Status" && $row[18] == "Category") {
            return null;
        }



        $status = in_array(strtolower($row[17]), ['available', 'blank']) ? strtolower($row[17]) : 'blank';

        return Books::create([
            "series_title" => $row[0],
            "call_no" => $row[1],
            "description" => $row[2],
            "publisher" => $row[3],
            "physical_description" => $row[4],
            "language" => $row[5],
            "isbn_issn" => $row[6],
            "classification" => $row[7],
            "content_type" => $row[8],
            "media_type" => $row[9],
            "carrier_type" => $row[10],
            "stock" => $row[11],
            "edition" => $row[12],
            "subject" => $row[13],
            "specific_details_info" => $row[14],
            "statement" => $row[15],
            "responsibility" => $row[16],
            "status" => $status,
            "category" => $row[18],
            "image" => "",
            "user_id" => 1,
        ]);
    }
}
