<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCustomers implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row[5]) || $row[5] =='SĐT') {
            return null;
        }

        return new Customer([
            'name'    => $row[1], 
            'tel'=> $row[5], 
            'created_at' => $row[7],
            'points'=>$row[8], 
        ]);
    }
}