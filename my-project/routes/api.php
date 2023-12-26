<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[RegisterController::class,'store']);
Route::get('show/{id}',[RegisterController::class,'edit']);
Route::get('list',[RegisterController::class,'registeruserlist']);
Route::post('update',[RegisterController::class,'updateuser']);

Route::post('/login', [RegisterController::class,'loginUser']);
