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

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/{conversation}', 'ChatController@index')->name('chat');
Route::put('/user', 'UserController@update')->name('user.update');
route::resource('user', 'UserController')->only('edit');
Route::resource('/api/conversation', 'ConversationController')->only('index', 'store', 'update', 'destroy');
Route::resource('/api/message', 'MessageController')->only('index', 'store', 'update', 'destroy');
