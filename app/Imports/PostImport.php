<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToArray, WithHeadingRow
{
    public function array(array $array)
    {
        $companyName = $array['cong_ty'];
        $language = $array['ngon_ngu'];
        $city = $array['dia_diem'];
        $link = $array['link'];

        Post::create([
           'job_title' => $language,
            'city' => $city,
            'status' =>1,
        ]);
    }
}
