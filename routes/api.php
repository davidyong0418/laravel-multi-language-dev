<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// pages
Route::group(['as' => 'pages.'], function () {
    Route::get('/{alias}', '\Nutnet\Artifico2\Pages\App\Http\Controllers\Pages\Pages@page')
        ->name('page')
        ->where('alias', '.*');
});
