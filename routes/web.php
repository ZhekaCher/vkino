<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {return view('welcome');});
Route::get('/', function (){return redirect('/films');});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function (){return redirect('/films');});
Route::get('/films', 'FilmsController@index');
Route::get('/films/favourites', 'FilmsController@favourites');
Route::get('/films/{filmId}', 'FilmsController@show');
Route::post('/imageUpload', 'ImageUploadController@avatarUploadPost');
Route::post('/deleteComment', 'CommentsController@deleteComment');
Route::post('/addComment', 'CommentsController@addComment');
Route::post('/addFavourite', 'FavouritesController@addFavourite');
Route::post('/addLike', 'LikesController@addLike');
Route::post('/deleteLike', 'LikesController@deleteLike');
Route::post('/deleteFavourite', 'FavouritesController@deleteFavourite');
Route::post('/deleteFilm', 'AdminController@deleteFilm');
