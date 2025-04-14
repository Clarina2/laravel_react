<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TacheController;

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
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');    



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/taches', [TacheController::class, 'index']);
    Route::post('/taches', [TacheController::class, 'store']);
    Route::get('/taches/{tache}', [TacheController::class, 'show']);
    Route::patch('/taches/{tache}/toggle', [TacheController::class, 'toggle']);
    Route::put('/taches/{tache}', [TacheController::class, 'update']);
    Route::delete('/taches/{tache}', [TacheController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/taches/status/{status}', [TacheController::class, 'filterByStatus']);

Route::middleware('auth:sanctum')->get('/tasks/all', [TaskController::class, 'allTasks']);
  
Route::middleware('auth:sanctum')->get('/taches/all', [TacheController::class, 'getAllWithUser']); // si tu veux voir les tâches de tout le monde
Route::middleware('auth:sanctum')->patch('/taches/toggle/{tache}', [TacheController::class, 'toggle']);

