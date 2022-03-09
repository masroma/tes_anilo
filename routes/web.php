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
        'uses' => 'ScoreController@index',
        'as' => 'score.index'
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

Route::prefix('subject')->group(
    function () {
        Route::get(
            '/data',
            [
                'uses' => 'SubjectController@data',
                'as' => 'subject.data'
            ]
        );
        Route::get(
            '/',
            [
                'uses' => 'SubjectController@index',
                'as' => 'subject.index'
            ]
        );
        Route::get(
            '/create',
            [
                'uses' => 'SubjectController@create',
                'as' => 'subject.create'
            ]
        );
        Route::post(
            '/store',
            [
                'uses' => 'SubjectController@store',
                'as' => 'subject.store'
            ]
        );
        Route::get(
            '/{id}/edit',
            [
                'uses' => 'SubjectController@edit',
                'as' => 'subject.edit'
            ]
        );
        Route::post(
            '/update/{id}',
            [
                'uses' => 'SubjectController@update',
                'as' => 'subject.update'
            ]
        );
        Route::get(
            '/{id}/delete',
            [
                'uses' => 'SubjectController@destroy',
                'as' => 'subject.destroy'
            ]
        );
    }
);

Route::prefix('score')->group(
    function () {
        Route::get(
            '/data',
            [
                'uses' => 'ScoreController@data',
                'as' => 'score.data'
            ]
        );
        Route::get(
            '/',
            [
                'uses' => 'ScoreController@index',
                'as' => 'score.index'
            ]
        );
        Route::get(
            '/create',
            [
                'uses' => 'ScoreController@create',
                'as' => 'score.create'
            ]
        );
        Route::post(
            '/store',
            [
                'uses' => 'ScoreController@store',
                'as' => 'score.store'
            ]
        );
        Route::get(
            '/{id}/edit',
            [
                'uses' => 'ScoreController@edit',
                'as' => 'score.edit'
            ]
        );
        Route::post(
            '/update/{id}',
            [
                'uses' => 'ScoreController@update',
                'as' => 'score.update'
            ]
        );
        Route::get(
            '/{id}/delete',
            [
                'uses' => 'ScoreController@destroy',
                'as' => 'score.destroy'
            ]
        );
    }
);
