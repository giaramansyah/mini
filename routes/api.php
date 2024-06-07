<?php

use App\Http\Api\AccountApi;
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

Route::post('auth', [AccountApi::class, 'auth']);

Route::group(['middleware' => ['jwt.verify']], function() {
    //auth
    Route::get('refresh', [AccountApi::class, 'refresh']);
    Route::post('logout', [AccountApi::class, 'logout']);
});

