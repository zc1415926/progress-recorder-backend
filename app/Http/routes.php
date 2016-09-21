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

Route::get('student/{grade}/{class}', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@getStudentByGradeClass'
]);

Route::post('student/create', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@create'
]);

Route::post('student/update', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@update'
]);

Route::post('student/delete', [
    'middleware' => 'cors',
    'uses'       => 'StudentsController@delete'
]);

/*Route::get('classEntry', [
    'uses'       => 'ClassEntryController@index'
]);*/

Route::get('gradeClasses', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@index'
]);

Route::post('gradeClasses/create', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@create'
]);

Route::post('gradeClasses/update', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@update'
]);

Route::post('gradeClasses/delete', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@delete'
]);

Route::get('gradeClasses/getGrades', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@getGrades'
]);

Route::post('gradeClasses/getClassesByGradeNum', [
    'middleware' => 'cors',
    'uses'       => 'GradeClassController@getClassesByGradeNum'
]);