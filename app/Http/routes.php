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


Route::get('/', [
    'middleware' => 'cors',
    'uses' => function () {
        return view('welcome');
    }
]);

Route::get('/2', [
    'uses' => function () {
        return view('welcome');
    }
]);

Route::post('returnformdata', [
    'middleware' => 'cors',
    'uses'       => 'FormController@returnFormData'
]);

Route::get('user/index', [
    'middleware' => 'cors',
    'uses'       => 'UserController@index'
]);

Route::get('student/index', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@index'
]);

Route::post('student/create', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@create'
]);

Route::post('student/update', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@update'
]);

Route::post('student/destory', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@destory'
]);

Route::get('classEntry', [
    'uses'       => 'ClassEntryController@index'
]);