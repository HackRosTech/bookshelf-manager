<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('\App\Http\Controllers\api\v1\\')
    ->group(function () {
        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return auth()->user();
        });

        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');

        Route::middleware('auth:api')->group(function () {

            Route::prefix('section')->group(function () {
                Route::get('/index', 'SectionController@index');
                Route::get('/show/{section}', 'SectionController@show');
                Route::post('/create', 'SectionController@create')->middleware('is_admin');
                Route::get('/edit/{section}', 'SectionController@edit')->middleware('is_admin');
                Route::patch('/update/{section}', 'SectionController@update')->middleware('is_admin');
                Route::delete('/delete/{section}', 'SectionController@delete')->middleware('is_admin');
            });

            Route::prefix('author')->group(function () {
                Route::get('/index', 'AuthorController@index');
                Route::get('/show/{author}', 'AuthorController@show');
                Route::post('/create', 'AuthorController@create')->middleware('is_admin');
                Route::get('/edit/{author}', 'AuthorController@edit')->middleware('is_admin');
                Route::patch('/update/{author}', 'AuthorController@update')->middleware('is_admin');
                Route::delete('/delete/{author}', 'AuthorController@delete')->middleware('is_admin');
            });

            Route::prefix('book')->group(function () {
                Route::get('/index', 'BookController@index');
                Route::get('/search', 'BookController@search');
                Route::get('/show/{book}', 'BookController@show');
                Route::post('/create', 'BookController@create');
                Route::get('/edit/{book}', 'BookController@edit');
                Route::post('/update/{book}', 'BookController@update');
                Route::delete('/delete/{book}', 'BookController@delete');
            });

        });

    });
