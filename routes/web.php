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

// Route::get('/', function () {
//     return view('welcome');
// });

// URl変更時にもnameを書いていいたら変更しなくても楽
Route::get('/', 'BlogController@index')->name('blogs');

// ブログ登録画面の表示
Route::get('/blog/create', 'BlogController@create')->name('create');

// ブログ登録
Route::post('/blog/store', 'BlogController@store')->name('store');

// ブログ詳細画面を表示
Route::get('/blog/{id}', 'BlogController@show')->name('show');

//編集画面を表示
Route::get('blog/edit/{id}' , 'BlogController@edit')->name('edit');

//編集
Route::post('blog/update/' , 'BlogController@update')->name('update');

//ブログ削除
Route::post('blog/delete/{id}' , 'BlogController@delete')->name('delete');