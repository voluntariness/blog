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

/* 基本上用不到 */
Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%', '%%>');




/* 使用 Google API 登入 */
Route::get('/oauth2callback', "SystemController@login" );
Route::get('/logout', "SystemController@logout" );


Route::get('/', "HomeController@index");
Route::get('/home', "HomeController@index");
Route::get('/home/{type}', "HomeController@index" );


Route::get('/link', "LinkController@index");

Route::get('/about', "AboutController@index");

Route::get('/manage', "ManageController@pageArticleList");
Route::get('/manage/article', "ManageController@pageArticleList");
Route::get('/manage/article/type/{type}', "ManageController@pageArticleList");
Route::get('/manage/article/view/{id}', "ManageController@pageArticleView");
Route::get('/manage/article/modify/{id}', "ManageController@pageArticleModify");
Route::post('/manage/article/save/{id}', "ManageController@pageArticleSave");
Route::post('/manage/article/delete/{id}', "ManageController@pageArticleDelete");

Route::get('/manage/message', "ManageController@pageMessageList");

Route::get('/manage/users', "ManageController@pageUsersList");
Route::get('/manage/parameter', "ManageController@pageParameterList");
Route::get('/manage/parameter/view/{group}', "ManageController@pageParameterList");
Route::post('/manage/parameter/save', "ManageController@pageParameterSave");
Route::post('/manage/parameter/delete', "ManageController@pageParameterDelete");
Route::get('/manage/parameter/ajax/{key}', "ManageController@pageParameterAjax");
