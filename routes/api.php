<?php

use App\Http\Controllers\TransactionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return json_encode(["status" => "online"]);
});

Route::get('/login', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('transactions')->group(function(){
    /* Get all transactions */
    Route::get('/',  [TransactionsController::class, 'index']);

    /* Get a especific transaction  */
    Route::get('/{id}', function (Request $request) {
        //
    })->middleware('auth:sanctum');

    Route::post('/store', function (Request $request) {
         //
    })->middleware('auth:sanctum');
});

