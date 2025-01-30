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

Route::get("/types", function(){
    $types = config('types');
    return response()->json($types);
});

Route::get("/categories", function(){
    $categories = config('categories');
    $jsonResponse = json_encode($categories, JSON_UNESCAPED_UNICODE);
    return response($jsonResponse, 200)->header('Content-Type', 'application/json; charset=UTF-8');         
});

