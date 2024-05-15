<?php

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [APIController::class, 'login']);
Route::post('register', [APIController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('accounts', [APIController::class, 'accounts']);
    Route::post('logout', [APIController::class, 'logout']);
});