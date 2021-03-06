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


Route::group(['middleware'=>['web']],function(){



    Route::get('/', function () {
        return view('welcome');
    });




    /*注意这里使用的位置用‘\’，而不是‘/’*/

    Route::any('admin/login', 'Admin\LoginController@login');

    Route::get('admin/code', 'Admin\LoginController@code');





});

Route::group(['middleware'=>['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){


    Route::get('index', 'IndexController@index');
    Route::get('quit', 'LoginController@quit');
    Route::get('info', 'IndexController@info');
    Route::any('pass', 'IndexController@pass');

    Route::post('cate/changeorder', 'CategoryController@changeorder');

    Route::resource('category', 'CategoryController');

});



