<?php

namespace App\Imports;

use App\Models\Items;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Items([
            //
            'Name'     => $row[0],
            'SerialNum'    => $row[1],
            'Quantity'    => $row[2],

        ]);
    }
}
