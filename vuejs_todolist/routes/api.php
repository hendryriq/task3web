<?php

use App\Http\Controllers\ApiTodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('todolist/read/{id}', [ApiTodoListController::class, 'getRead']);
Route::get('todolist/list', [ApiTodoListController::class, 'getList']);
Route::post('todolist/create', [ApiTodoListController::class, 'postCreate']);
Route::get('todolist/read/{id}', [ApiTodoListController::class, 'getRead']);
Route::post('todolist/update/{id}', [ApiTodoListController::class, 'postUpdate']);
Route::post('todolist/delete/{id}', [ApiTodoListController::class, 'postDelete']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
