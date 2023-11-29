<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\AuthController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    
    Route::prefix('v1/cards')->group(function () {
        Route::get('/',[ CardController::class, 'get']);
        Route::post('/',[ CardController::class, 'create']); 
        Route::get('/{id}',[ CardController::class, 'getById']);
        Route::put('/{id}',[ CardController::class, 'update']);
        Route::delete('/{id}',[ CardController::class, 'delete']);
    });
});
