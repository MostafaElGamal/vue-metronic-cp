<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::view('/', 'Dashboard');
Route::view('/{dashboard}', 'Dashboard');
Route::view('/{dashboard}/{action}', 'Dashboard');
Route::view('/{dashboard}/{action}/{id}', 'Dashboard');

// // -------------------------- Roles Web Routes --------------------------------
// Route::view('/roles', 'Dashboard');
// Route::view('/roles/new-role', 'Dashboard');
// Route::view('/roles/edit-role/{dashboard}', 'Dashboard');

// // -------------------------- Users Web Routes --------------------------------
// Route::view('/users', 'Dashboard');
// Route::view('/users/new-user', 'Dashboard');
// Route::view('/users/edit-user/{dashboard}', 'Dashboard');
