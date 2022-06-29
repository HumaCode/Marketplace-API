<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TokoController;
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

Route::post('login', [AuthController::class, 'login']);   // api login
Route::post('register', [AuthController::class, 'register']);   // api register
Route::put('update-user/{id}', [AuthController::class, 'update']);    // api ubah profil
Route::post('upload-user/{id}', [AuthController::class, 'upload']);  // api upload foto


Route::resource('toko', TokoController::class);
Route::get('toko-user/{id}', [TokoController::class, 'cekToko']);
