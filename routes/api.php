<?php

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return json_encode(["status" => "online"]);
});

Route::post('/login', [UsersController::class,'login']);
Route::post('/register', [UsersController::class,'register']);
Route::post('/logout', [UsersController::class,'logout'])->middleware('auth:sanctum');

Route::prefix('transactions')->group(function(){

    Route::get('/',  [TransactionsController::class, 'index']);
    
    Route::get('/{id}',[TransactionsController::class, 'show']);

    Route::post('/store', [TransactionsController::class, 'store']);

    Route::put('/update/{id}', [TransactionsController::class, 'update']);

    Route::post('/excelUpload', [TransactionsController::class, 'excelUpload']);

})->middleware('auth:sanctum');

Route::get("/types_transactions", function(){
    $types = config('types');
    return response()->json($types);
})->middleware('auth:sanctum');

Route::get("/types_excel", function(){
    $typesImportExcel = config('typesImportExcel');
    $res = [];
    foreach ($typesImportExcel as $key => $type) {
        $exploded = explode('\\',$type);
        $res[$key]=$exploded[2];
    }
    $jsonResponse = json_encode($res, JSON_UNESCAPED_UNICODE);
    return response($jsonResponse, 200)->header('Content-Type', 'application/json; charset=UTF-8');
})->middleware('auth:sanctum');

Route::get("/categories", function(){
    $categories = config('categories');
    $jsonResponse = json_encode($categories, JSON_UNESCAPED_UNICODE);
    return response($jsonResponse, 200)->header('Content-Type', 'application/json; charset=UTF-8');         
})->middleware('auth:sanctum');

