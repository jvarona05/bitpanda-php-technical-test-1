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

Route::prefix('v1')->group(function () {
    Route::get('users', 'UserController@index')
        ->name('api.users');
    
    Route::get('austria/users', 'UserController@getAustrianUsers')
        ->name('api.austria.users');

    Route::put('users/{id}/details', 'UserController@updateDetails')
        ->name('api.update.user.details')->where(['id' => '^[-+]?\d*$']);
    
    Route::delete('users/{id}', 'UserController@delete')
        ->name('api.delete.user')->where(['id' => '^[-+]?\d*$']);
});