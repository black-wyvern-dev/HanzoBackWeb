<?php

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

Route::post('login', 'App\Http\Controllers\Api\AuthenticationController@login');
Route::post('register', 'Api\AuthenticationController@register');

Route::middleware('auth:api')->group(function() {
    Route::post('postshill', 'App\Http\Controllers\Api\ShillController@PostShill');
    Route::post('fileUpload', 'App\Http\Controllers\Api\ResourceController@fileUpload');
});
