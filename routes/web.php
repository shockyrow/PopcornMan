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
    return redirect(Route('movies.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => '/movies'], function () {
    Route::get('/loved', 'MovieController@loved')->name('movies.loved');
    Route::get('/hated', 'MovieController@hated')->name('movies.hated');
    Route::get('/recommended', 'MovieController@recommended')->name('movies.recommended');
    Route::post('/{movie}/toggle_like', 'MovieController@toggleLike')->name('movies.toggleLike');
    Route::post('/{movie}/toggle_dislike', 'MovieController@toggleDislike')->name('movies.toggleDislike');
});

Route::group(['middleware' => 'auth', 'prefix' => '/comments/{comment}'], function () {
    Route::post('/toggle_like', 'CommentController@toggleLike')->name('comments.toggleLike');
    Route::post('/toggle_dislike', 'CommentController@toggleDislike')->name('comments.toggleDislike');
});

Route::resources([
    '/movies' => 'MovieController',
    '/genres' => 'GenreController',
    '/comments' => 'CommentController',
]);