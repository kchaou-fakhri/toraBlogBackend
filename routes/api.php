<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});

Route::group(['prefix' => 'post', 'middleware' => ['auth:sanctum']], function () {
    Route::post('/create', [PostController::class, 'create']);
    Route::get('/', [PostController::class, 'getall']);
    Route::get('/getbyid/{id}', [PostController::class, 'getbyid']);
    Route::post('/update', [PostController::class, 'update']);
    Route::post('/delete/{id}', [PostController::class, 'delete']);
});

Route::group(['prefix' => 'auth', 'middleware' => ['auth:sanctum']], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('/', [UserController::class, 'getAll']);
    Route::get('getbyid/{id}', [UserController::class, 'getById']);
    
});

Route::prefix('users')->group(function () {

   
    Route::post('login',    [LoginController::class,    'login']);
    Route::post('logout',   [LoginController::class,    'logout']);

  //  Route::get('check',     [LoginController::class,    'CheckAuth']);
});
