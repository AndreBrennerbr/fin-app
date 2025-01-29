<?php

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return json_encode(["status" => "online"]);
});

Route::get('/login', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [UsersController::class,'register']);/* ->middleware('auth:sanctum') */

Route::prefix('transactions')->group(function(){

    Route::get('/',  [TransactionsController::class, 'index']);
    
    Route::get('/{id}',[TransactionsController::class, 'show']);

    Route::post('/store', [TransactionsController::class, 'store']);

    Route::put('/update/{id}', [TransactionsController::class, 'update']);

});

