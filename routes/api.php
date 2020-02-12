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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('search', 'ImageController@searchImage')->name('search');

//Route::get('search', 'ImageController@randomImage')->name('search');

Route::post('like', 'ImageController@likeImage')->name('like');

Route::post('getCollectionsByUserId', 'CollectionController@getCollectionsByUserId')->name('getCollectionsByUserId');

Route::resource('collections', 'CollectionController');

Route::post('addImage', 'ImageController@addImage')->name('addImage');

Route::post('addToCollection', 'ImageController@addToCollection')->name('addToCollection');

Route::post('deleteCollection', 'CollectionController@destroy')->name('deleteCollection');

Route::post('deleteImages', 'CollectionController@deleteImages')->name('deleteImages');

Route::post('seeCollectionDetails', 'CollectionController@seeCollectionDetails')->name('seeCollectionDetails');
