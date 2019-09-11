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
\
Route::get('/', 'ViewController@showHomePage');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

//only allow access to login if connected to the DB via the connected middleware
Route::post('/login', 'Auth\LoginController@login')->name('login')->middleware('connected');

//CRUD operations - only available if logged in
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'ViewController@showAdminDashboard');
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::post('/createTag', 'TagController@createTag');
    Route::get('/getTags', 'TagController@getTags');
    Route::post('/updateTag', 'TagController@updateTag');
    Route::post('/deleteTag', 'TagController@deleteTag');
});



