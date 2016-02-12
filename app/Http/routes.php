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

///////////////////////////////////////////////
/////////// Authentication
///////////////////////////////////////////////

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


///////////////////////////////////////////////
/////////// Backoffice CMS
///////////////////////////////////////////////

Route::group(['middleware' => 'auth'], function () {
	// Registration routes...
	Route::get('panel/auth/register', 'Auth\AuthController@getRegister');
	Route::post('panel/auth/register', 'Auth\AuthController@postRegister');

    Route::get('panel', 'MainRouteController@panel');

    Route::get('panel/admin-list', 'MainRouteController@adminList');
		Route::get('panel/city-list', 'MainRouteController@cityList');
		Route::post('panel/update/{id}', 'LocalidadRESTController@updateHidden');
		Route::get('panel/logged', 'AdminRESTController@logged');



});

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


///////////////////////////////////////////////
/////////// REST API
///////////////////////////////////////////////

Route::get('api-provincia/pais/{id}', 'ProvinciaRESTController@showByPais');
Route::get('api-localidad/provincia/{id}', 'LocalidadRESTController@showByProvincia');

Route::get('api-pais/nombre/{nombre}', 'PaisRESTController@showByNombre');
Route::get('api-provincia/nombre/{nombre}', 'ProvinciaRESTController@showByNombre');
Route::get('api-localidad/nombre/{nombre}', 'LocalidadRESTController@showByNombre');
Route::get('api-localidad/panel', 'LocalidadRESTController@showWithProvincia');


Route::get('/', 'MainRouteController@home');
Route::get('/provincia/{pid}', 'MainRouteController@provincia');
Route::get('/provincia/{pid}/localidad/{cid}', 'MainRouteController@localidad');
Route::get('/provincia/{pid}/localidad/{cid}/li', 'MainRouteController@li');
Route::get('/provincia/{pid}/localidad/{cid}/li24', 'MainRouteController@li24');
Route::get('/form', 'MainRouteController@form');
Route::get('/confirmation', 'MainRouteController@formConfirmation');
Route::get('/informacion', 'MainRouteController@information');
Route::get('/terminos', 'MainRouteController@terms');
Route::get('/download', 'MainRouteController@download');


Route::any('{all}', 'MainRouteController@notFound')->where('all', '.*');