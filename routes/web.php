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

//campaign

Route::post('/campaign/create', 'CampaignController@store')->name('campaign_create')->middleware('auth');

Route::post('/campaign/edit', 'CampaignController@update')->name('campaign_edit')->middleware('auth');

Route::post('/campaign/delete', 'CampaignController@remove')->name('campaign_delete')->middleware('auth');

Route::post('/campaign/close', 'CampaignController@close')->name('campaign_close')->middleware('auth');