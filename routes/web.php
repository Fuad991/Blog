<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;//هاي اذا اعطت الاوث ايرور

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile','ProfileContrpller@index')->name('profile');

Route::put('/profile/update','ProfileContrpller@update')->name('profile.update');

//routes for posts

Route::get('/posts','PostController@index')->name('posts');

Route::get('/posts/trashed','PostController@trashed')->name('posts.trashed');

Route::get('/post/create','PostController@create')->name('post.create');

Route::post('/post/store','PostController@store')->name('post.store');

Route::get('/post/show/{slug}','PostController@show')->name('post.show');

Route::get('/post/edit/{id}','PostController@edit')->name('post.edit');

Route::post('/post/update/{id}','PostController@update')->name('post.update');

Route::get('/post/destroy/{id}','PostController@destroy')->name('post.destroy');

Route::get('/post/delete/{id}','PostController@delete')->name('post.delete');

Route::get('/post/restore/{id}','PostController@restore')->name('post.restore');


//routes for tags

Route::get('/tags','TagController@index')->name('tags');

Route::get('/tag/create','TagController@create')->name('tag.create');

Route::post('/tag/store','TagController@store')->name('tag.store');

Route::get('/tag/show/{slug}','TagController@show')->name('tag.show');

Route::get('/tag/edit/{id}','TagController@edit')->name('tag.edit');

Route::post('/tag/update/{id}','TagController@update')->name('tag.update');

Route::get('/tag/destroy/{id}','TagController@destroy')->name('tag.destroy');


//routes for users

Route::get('/users','UserController@index')->name('users');

Route::post('/user/create','UserController@create')->name('user.create');

Route::post('/user/store','UserController@store')->name('user.store');

Route::get('/user/destroy/{id}','UserController@destroy')->name('user.destroy');
