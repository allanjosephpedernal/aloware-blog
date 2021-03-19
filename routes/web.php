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

// post
Route::get('/','PostController@index');
Route::get('/post/comment/{post_id?}','PostController@getPostComments');
Route::resource('post','PostController',['only'=>['show']]);

// comment
Route::resource('comment','CommentController',['only'=>['store']]);