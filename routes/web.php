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

Route::get(
    '/',
    [
        'uses' => 'StudentController@index',
                'as' => 'student.index'
    ]
);
Route::prefix('student')->group(
    function () {
        Route::get(
            '/data',
            [
                'uses' => 'StudentController@data',
                'as' => 'student.data'
            ]
        );
        Route::get(
            '/',
            [
                'uses' => 'StudentController@index',
                'as' => 'student.index'
            ]
        );
        Route::get(
            '/create',
            [
                'uses' => 'StudentController@create',
                'as' => 'student.create'
            ]
        );
        Route::post(
            '/store',
            [
                'uses' => 'StudentController@store',
                'as' => 'student.store'
            ]
        );
        Route::get(
            '/{id}/edit',
            [
                'uses' => 'StudentController@edit',
                'as' => 'student.edit'
            ]
        );
        Route::post(
            '/update/{id}',
            [
                'uses' => 'StudentController@update',
                'as' => 'student.update'
            ]
        );
        Route::get(
            '/{id}/delete',
            [
                'uses' => 'StudentController@destroy',
                'as' => 'student.destroy'
            ]
        );
    }
);
