<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/note', [NoteController::class, 'create']);
Route::middleware('auth:sanctum')->get('/note', [NoteController::class, 'list']);
Route::middleware('auth:sanctum')->get('/note/{note}', [NoteController::class, 'get']);
Route::middleware('auth:sanctum')->put('/note/{note}', [NoteController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/note/{note}', [NoteController::class, 'delete']);
