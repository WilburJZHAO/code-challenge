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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', function (){
    return view('dashboard');
})->middleware(['auth', 'admin']);

Route::get('/dashboard', function (){
    return view('dashboard');
});

Route::get('/test', function () {
    return \App\Utilities\Unplash::getImages('London');
});

Route::get('/test1', function () {
    return view('test');
});

Route::get('/vue', function () {
    return view('vue');
});

Route::get('/database', 'DatabaseController@index')->name('database');

Route::get('/aaa', 'ImagesSearchController@aa');

Route::resource('image', 'ImageController');

Route::get('/aaa', 'ImageController@randomImage1');

Route::get('/search', function () {
    return view('search');
});

Route::post('getUserLikes', 'ImageController@getUserLikes')->name('getUserLikes');

Route::get('/editProfile', function () {
    return view('editProfile');
});
