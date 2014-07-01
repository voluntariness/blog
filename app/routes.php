<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::post('register', array('before' => 'csrf', function( )
// {
//     return '你給了一個合法的 CSRF 標記!';
// }));

Route::post('/ajax/login', "SystemController@login" );


Route::get('/', "ArticleController@index");
Route::get('/article', "ArticleController@index");
Route::get('/article/{type}', "ArticleController@index" );


Route::get('/about', "AboutController@index");


