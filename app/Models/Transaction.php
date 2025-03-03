<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Transaction extends Model
{
    protected $fillable = ['type', 'category', 'value','description','date_created_transaction'];

    protected $hidden = [
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->user_id = Auth::id(); // Define o usuário automaticamente
        });
    }

}
