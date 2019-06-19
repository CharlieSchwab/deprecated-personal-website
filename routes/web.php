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
Auth::routes(['register' => false]);

Route::get('/', 'ViewController@showHomePage');
Route::get('/all-projects', 'ViewController@showAllProjects');


//CRUD operations
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'ViewController@showAdminDashboard');
    Route::get('/logout', 'Auth\LoginController@logout');

    
    Route::post('/createTag', 'TagController@createTag');
    Route::get('/getTags', 'TagController@getTags');
    Route::post('/updateTag', 'TagController@updateTag');
    Route::get('/deleteTag/{id}', 'TagController@deleteTag');
});



