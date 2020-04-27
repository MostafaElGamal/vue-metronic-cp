<?php

use Illuminate\Http\Request;
use App\Http\Resources\Users\UserResource;

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



Route::post('/login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function () {

    ////////////////////////////////////////// LOGOUT   //////////////////////////////////////////
    Route::post('/logout', 'AuthController@logout')->name('login');

    ////////////////////////////////////////// ROLES API RESOURCE   //////////////////////////////////////////
    Route::apiResource('/role', 'RoleController');
    Route::get('/newRole', 'RoleController@index_02');
    Route::get('/permissions', 'RoleController@permissions');
    Route::put('/role/activate/{role}', 'RoleController@activate')->name('role.activate');
    Route::put('/role/deactivate/{role}', 'RoleController@deactivate')->name('role.deactivate');
    Route::post('/role/findRoles/', 'RoleController@findRoles')->name('search.roles');


    ////////////////////////////////////////// Users API RESOURCE   //////////////////////////////////////////
    Route::apiResource('/users', 'UsersController');
    Route::post('/users/findUser/', 'UsersController@findUser')->name('search.users');
    Route::put('/users/admin/{user}', 'UsersController@admin');
    Route::put('/users/activate/{user}', 'UsersController@activate')->name('users.activate');
    Route::put('/users/deactivate/{user}', 'UsersController@deactivate')->name('users.deactivate');
});
