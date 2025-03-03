<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class TransactionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'type' => $row[0],
            'category' => $row[1],
            'value'=> (float) $row[2],
            'description' => $row[3],
            'date_created_transaction' => $row[4]
        ]);
    }
}
