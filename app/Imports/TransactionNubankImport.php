<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class TransactionNubankImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */  

    public function model(array $row)
    {   
        return new Transaction([
            'date_created_transaction' => $row[0],
            'description' => $row[1],
            'value'=> $row[2]
        ]);
    }
}
