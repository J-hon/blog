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

Route::group(['middleware' => ['web']], function (){
    //Authentication routes

    Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::post('auth/logout', 'Auth\LoginController@logout');

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    // Registration Routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    //Password Routes
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // Categories Routes
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    // Tags Routes
    Route::resource('tags', 'TagController', ['except' => ['create']]);

    // Comment routes
    Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
    Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
    Route::put('comments/{id}/update', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
    Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
    Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);


    //the where clause restricts the type of information being passed into the slug using regular expressions.
    //therefor it won't accept any 'slug' that falls outside the regular expression thereby retuning an error 404 page
    Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
    Route::get('/', 'PagesController@getIndex');
    Route::get('about', 'PagesController@getAbout');

    // Contact Routes
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');

    Route::resource('posts', 'PostController');

});