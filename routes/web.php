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

//landing

Route::get('/', function () { return view('welcome'); });

//auth

Auth::routes();

//home

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//social

Route::post('/social/login', 'UserController@socialLogin')->name('social_login');

//SSL

Route::get('/.well-known/acme-challenge/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I', 'SSLController@File1')->name('SSL1');

Route::get('/.well-known/acme-challenge/mvjuKMRHhsfYoqxJwpVAvnYnH4mEoPiL06dLo2Epr1A', 'SSLController@File2')->name('SSL2');

//ssl debug

Route::get('/well-known/acme-challenge/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I', 'SSLController@File1')->name('SSL1');
