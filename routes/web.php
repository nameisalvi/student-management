<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('student');
});

Route::get('student', ['as' => 'student', 'uses' => '\App\Http\Controllers\StudentController@index']);
Route::post('student/save', ['as' => 'student.add', 'uses' => '\App\Http\Controllers\StudentController@save']);
Route::get('student/edit/{id}', ['as' => 'student.edit', 'uses' => '\App\Http\Controllers\StudentController@edit']);
Route::get('student/delete/{id}', ['as' => 'student.delete', 'uses' => '\App\Http\Controllers\StudentController@delete']);

Route::get('mark', ['as' => 'mark', 'uses' => '\App\Http\Controllers\MarkController@index']);
Route::post('mark/save', ['as' => 'mark.add', 'uses' => '\App\Http\Controllers\MarkController@save']);
Route::get('mark/edit/{id}', ['as' => 'mark.edit', 'uses' => '\App\Http\Controllers\MarkController@edit']);
Route::get('mark/delete/{id}', ['as' => 'mark.delete', 'uses' => '\App\Http\Controllers\MarkController@delete']);
