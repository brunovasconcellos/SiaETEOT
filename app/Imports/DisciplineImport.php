<?php

namespace App\Imports;

use App\Discipline;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisciplineImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Discipline([
            "discipline_name" => $row['name'],
            "discipline_abbreviation" => $row['workload'],
        ]);
    }
}
