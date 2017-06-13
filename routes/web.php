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
    return redirect()->action('ResourceController@index');
});

Auth::routes();


Route::group(['middleware' => ['web', 'admin_auth_group']], function(){
	Route::get('users', 'UserController@index');
	//Route::get('users/{user}/edit', 'UserController@edit');
	//Route::put('users/{user}', 'UserController@update');
	//Route::patch('users/{user}', 'UserController@update');

	Route::get('resources/unpublished', 'ResourceController@getUnpublished');
	Route::put('resources/{resource}/publish', 'ResourceController@publish');
	Route::patch('resources/{resource}/publish', 'ResourceController@publish');
	Route::put('resources/{resource}/unpublish', 'ResourceController@unpublish');
	Route::patch('resources/{resource}/unpublish', 'ResourceController@unpublish');
	Route::get('resources/{resource}/edit', 'ResourceController@edit');
	Route::put('resources/{resource}', 'ResourceController@update');
	Route::patch('resources/{resource}', 'ResourceController@update');
	Route::delete('resources/{resource}', 'ResourceController@destroy');

	Route::get('tags', 'TagController@index');
	//Route::get('tag/{tag}/edit', 'TagController@edit');
	Route::put('tags/{tag}', 'TagController@update');
	Route::patch('tags/{tag}', 'TagController@update');
	Route::delete('tags/{tag}', 'TagController@destroy');
});


Route::group(['middleware' => ['web', 'admin_or_self_auth_group']], function(){
	Route::get('users/{user}', 'UserController@show');
	Route::delete('users/{user}', 'UserController@destroy');
});



Route::get('resources/create', 'ResourceController@create');
Route::post('resources', 'ResourceController@store');
Route::post('tag', 'TagController@store');


Route::get('resources', 'ResourceController@index');
//Route::get('resources/{resource}', 'ResourceController@show')->where('resource', '[0-9]+');;

Route::get('resources/has-all/{query?}', 'ResourceController@hasAll');
Route::get('resources/has-any/{query?}', 'ResourceController@hasAny');
Route::get('resources/search/{query?}', 'ResourceController@search');

Route::get('resources/about', function(){
	return view('about')->render();
});


//Bad routes that we still want to handle
Route::any('{all}', function(){
    abort(404);
})->where('all', '.*');
















