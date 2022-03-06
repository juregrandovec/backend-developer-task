<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteFolderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/notes', [NoteController::class, 'create']);
Route::middleware('auth:sanctum')->get('/notes', [NoteController::class, 'list']);
Route::middleware('auth:sanctum')->get('/notes/{note}', [NoteController::class, 'get']);
Route::middleware('auth:sanctum')->put('/notes/{note}', [NoteController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/notes/{note}', [NoteController::class, 'delete']);

Route::middleware('auth:sanctum')->post('/folders', [NoteFolderController::class, 'create']);
Route::middleware('auth:sanctum')->get('/folders', [NoteFolderController::class, 'list']);
Route::middleware('auth:sanctum')->get('/folders/{folder}', [NoteFolderController::class, 'get']);
Route::middleware('auth:sanctum')->put('/folders/{folder}', [NoteFolderController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/folders/{folder}', [NoteFolderController::class, 'delete']);
