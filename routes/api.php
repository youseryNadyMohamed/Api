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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('user/register', 'APIRegisterController@register');//make registration
Route::post('user/login', 'APILoginController@login');//make login

Route::middleware('jwt.auth')->get('users',
    function(Request $request) {
    return auth()->user();
});

Route::get('showmoviewithnum', 'API\ApiController@showmoviewithnum');//show movie with pagination
Route::get('filter', 'API\ApiController@filter'); //show movie with filter data on Genre
Route::get('showmoviewithcriteria', 'API\ApiController@showmoviewith'); //show movie on  order by citeria
Route::get('movie', 'API\ApiController@index'); //show all movie
Route::get('movie/{id}', 'API\ApiController@show');//show movie
Route::post('addmovie', 'API\ApiController@store');//add movie
Route::post('updatemovie/{id}', 'API\ApiController@update');//update movie
Route::post('deletemovie/{id}', 'API\ApiController@destroy');//delete movie
