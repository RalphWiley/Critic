<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('user-ratings', 'RatingController@getUserRatings');
Route::get('ratings', 'RatingController@index');
Route::get('rating/{id}', 'RatingController@show');
// Route::get('rating/{user_id}', 'RatingController@show');
Route::post('rating', 'RatingController@store');
Route::put('ratings/{id}', 'RatingController@update');
Route::delete('ratings/{id}', 'RatingController@delete');

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\RegisterController@login']);

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('/users/{id}/ratings', 'UserController@userRatings')->name('ratings');
    Route::get('me', 'MeController');

    Route::post('/send', 'UserController@sendRequest');
});
