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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
//Route::resource('threads', 'ThreadsController');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::get('/threads/create', 'ThreadsController@create');

Route::get('threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');
Route::post('/threads', 'ThreadsController@store')->middleware('must-be-confirmed');
Route::get('/threads/{channel?}', 'ThreadsController@index')->name('threads');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
Route::post('replies/{reply}/favorites', 'FavoritesController@store');
Route::post('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::delete('replies/{reply}/favorites', 'FavoritesController@destroy');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
Route::get('api/users', 'Api\UsersController@index');
Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->name('avatar');
