<?php

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyControllerr;
use App\Http\Controllers\EmpController;

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
// routes/api.php



Route::post('updateuser', [MyController::class, 'updateUser']);
Route::get('/show', [MyController::class, 'index']);
Route::get('/show/{id}',[MyController::class, 'show']);
Route::post('/insert', [MyController::class, 'store']);
Route::delete('/tasks/{id}', [MyController::class, 'destroy']);
Route::get('/count', [MyController::class, 'count']);
//Route::post('/upload', [MyController::class, 'upload']);

//service file api
Route::post('addemp',[EmpController::class,'store']);
Route::get('emp/{id}',[EmpController::class,'edit']);
Route::post('update-emp',[EmpController::class,'update']);
Route::get('delete-emp/{id}',[EmpController::class,'destroy']);
Route::get('emp_title-list',[EmpController::class,'emplist']);
Route::get('emp_type-list',[EmpController::class,'emptitle']);
    