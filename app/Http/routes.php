<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

/**
 * Static Routes
 */
Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);

Route::get('about', [
	'as' => 'about',
	'uses' => 'PageController@about'
]);

Route::get('search', [
	'as' => 'search',
	'uses' => 'PageController@search'
]);

Route::get('about', [
	'as' => 'about',
	'uses' => 'PageController@about'
]);

Route::get('faq', [
	'as' => 'faq',
	'uses' => 'PageController@faq'
]);

/**
 * User Related Items
 */

Route::get('user/{id}/replies', [
	'as' => 'user.replies',
	'uses' => 'UsersController@replies'
]);

Route::get('user/{id}/topics', [
	'as' => 'user.topics',
	'uses' => 'UsersController@topics'
]);

Route::get('user/{id}/favorites', [
	'as' => 'user.favorites',
	'uses' => 'UsersController@favorites'
]);

Route::get('notifications', [
	'middleware' => 'auth',
	'as' => 'notifications.index',
	'uses' => 'NotificationsController@index',
]);

Route::get('notifications/count', [
	'middleware' => 'auth',
	'as' => 'notifications.count',
	'uses' => 'NotificationsController@count'
]);

Route::get('attentions/{id}', [
	'middleware' => 'auth',
	'as' => 'attentions.createOrDelete',
	'uses' => 'AttentionsController@createOrDelete'
]);

Route::post('upload_image', [
	'middleware' => 'auth', 
	'as' => 'upload_image',
	'uses' => 'TopicsController@uploadImage'
]);

/**
 * Resource Routes
 */

Route::resource('users', 'UsersController');
Route::resource('nodes', 'NodesController');
Route::resource('votes', 'VotesController');
Route::resource('topics', 'TopicsController');


/**
 * Authentication
 */

Route::get('login', [
	'as' => 'login',
	'uses' => 'Auth\AuthController@login'
]);

Route::get('signup',[
	'as' => 'signup',
	'uses' => 'Auth\AuthController@create'
]);

Route::post('signup', [
	'as' => 'signup',
	'uses' => 'Auth\AuthController@store'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'Auth\AuthController@logout'
]);

Route::get('loginRequired', [
	'as' => 'loginRequired',
	'uses' => 'Auth\Authentication@loginRequired'
]);

Route::get('adminRequired', [
	'as' => 'adminRequired',
	'uses' => 'Auth\Authentication@adminRequired'
]);

Route::get('userBanned', [
	'as' => 'userBanned', 
	'uses' => 'Auth\AuthController@userBanned'
]);


/**
 * Vote
 */

Route::group(['middleware' => 'auth'], function()
{
	Route::post('topics/{id}/upvote', [
		'as' => 'topics.upvote',
		'uses' => 'TopicsController@upvote'
	]);

	Route::post('topics/{id}/downvote', [
		'as' => 'topics.downvote',
		'uses' => 'TopicsController@downvote'
	]);

	Route::post('replies/{id}/vote', [
		'as' => 'replies.vote',
		'uses' => 'RepliesController@vote'
	]);
});

/**
 * Topics Appends
 */

Route::post('topics/{id}/append', [
	'middleware' => 'auth',
	'as' => 'topics.append',
	'uses' => 'TopicsController@append'
]);

/**
 * Admin Related Routes
 */

Route::group(['middleware' => 'manage_topics'], function()
{
	Route::post('topics/recommed/{id}', [
		'as' => 'topics.recommend',
		'uses' => 'TopicsController@recommend'
	]);

	Route::post('topics/pin/{id}', [
		'as' => 'topics.pin',
		'uses' => 'TopicsController@pin'
	]);

	Route::post('topics/sink/{id}', [
		'as' => 'topics.sink',
		'uses' => 'TopicsController@sink'
	]);

	Route::delete('topics/delete/{id}', [
		'as' => 'topics.destroy',
		'uses' => 'TopicsController@destroy'
	]);
});

Route::group(['middleware' => 'manage_users'], function()
{
	Route::post('users/blocking/{id}', [
		'as' => 'users.blocking',
		'uses' => 'UsersController@blocking'
	]);
});