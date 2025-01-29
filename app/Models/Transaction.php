<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'user_id', 'category', 'value','description','date_created_transaction'];

    protected $hidden = [
        'user_id'
    ];

}
