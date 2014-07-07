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
Route::get('/home/type/{type}', "HomeController@index");
Route::get('/home/view/{id}', "HomeController@pageView" );


Route::get('/link', "LinkController@index");

Route::get('/about', "AboutController@index");

/* 文章管理 */
Route::get('/manage', "ManageController@pageArticleList");
Route::get('/manage/article', "ManageController@pageArticleList");
Route::get('/manage/article/type/{type}', "ManageController@pageArticleList");
Route::get('/manage/article/view/{id}', "ManageController@pageArticleView");
Route::get('/manage/article/modify/{id}', "ManageController@pageArticleModify");
Route::post('/manage/article/save', "ManageController@pageArticleSave");
Route::post('/manage/article/delete', "ManageController@pageArticleDelete");

/* 留言管理 */
Route::get('/manage/message', "ManageController@pageMessageList");

/* 靜態頁管理 */
Route::get('/manage/pages', "ManageController@pagePagesList");
Route::get('/manage/pages/list/{id}', "ManageController@pagePagesList");
Route::get('/manage/pages/modify/{id}', "ManageController@pagePagesModify");
Route::post('/manage/pages/save', "ManageController@pagePagesSave");
Route::post('/manage/pages/delete', "ManageController@pagePagesDelete");

/* 成員管理 */
Route::get('/manage/users', "ManageController@pageUsersList");

/* Parameter - 參數管理 */
Route::get('/manage/parameter', "ManageController@pageParameterList");
Route::get('/manage/parameter/view/{group}', "ManageController@pageParameterList");
Route::post('/manage/parameter/save', "ManageController@pageParameterSave");
Route::post('/manage/parameter/delete', "ManageController@pageParameterDelete");

Route::get('/manage/ajax/{key}', "ManageController@callAjax");
