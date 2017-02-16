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

Route::resource('articles', 'ArticleController');
Route::resource('users', 'UserController');

Route::put('comments/{id}', [
    'uses' => 'CommentController@update',
    'as' => 'comments.update'
]);

Route::delete('comments/{id}', [
    'uses' => 'CommentController@destroy',
    'as' => 'comments.destroy'
]);

Route::get('/comments/{id}/edit', [
    'uses' => 'CommentController@edit',
    'as' => 'comments.edit'
]);
Route::post('/comments/store/{id}', [
    'uses' => 'CommentController@store',
    'as' => 'comments.store'
    ]);
Route::get('/images/{filename}', [
    'uses' => 'ArticleController@getUploadedImage',
    'as' => 'articles.image'
]);

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/like', [
    'uses' => 'ArticleController@articleLikeArticle',
    'as' => 'like'
]);

Route::get('/admin/', [
    'uses' => 'AdminController@index',
    'as' => 'admin.index'
]);

Route::get('/admin/articles', [
    'uses' => 'AdminController@articles',
    'as' => 'admin.articles'
]);

Route::get('/admin/comments/{id}', [
    'uses' => 'AdminController@comments',
    'as' => 'admin.comments'
]);

Route::get('/contact/', [
    'uses' => 'ContactController@create',
    'as' => 'contact.index'
]);

Route::post('/contact/', [
    'uses' => 'ContactController@store',
    'as' => 'contact.store'
]);

Route::get('/admin/contact', [
    'uses' => 'ContactController@index',
    'as' => 'admin.contact'
]);

Route::delete('contact/{id}', [
    'uses' => 'ContactController@destroy',
    'as' => 'contact.destroy'
]);

Route::group(['prefix' => ''], function () {
    Route::get('/messenger', ['as' => 'messages', 'uses' => 'MessageController@index']);
    Route::get('/messenger/create', ['as' => 'messages.create', 'uses' => 'MessageController@create']);
    Route::post('/messenger', ['as' => 'messages.store', 'uses' => 'MessageController@store']);
    Route::get('/messenger/{id}', ['as' => 'messages.show', 'uses' => 'MessageController@show']);
    Route::put('/messenger/{id}', ['as' => 'messages.update', 'uses' => 'MessageController@update']);
});