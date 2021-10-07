<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('post')->group(function (){
    Route::post('/create', [PostController::class, 'create']);
    Route::get('/', [PostController::class, 'getall']);
    Route::get('/getbyid/{id}', [PostController::class, 'getbyid']);
    Route::post('/update', [PostController::class, 'update']);
    Route::post('/delete/{id}', [PostController::class, 'delete']);
});

Route::prefix('user')->group(function(){

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('loginn', [LoginController::class, 'login']);
});
