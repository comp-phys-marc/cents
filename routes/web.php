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

//users

Route::get('/profile', 'UserController@index')->name('profile')->middleware('auth');

Route::post('/update', 'UserController@update')->name('update')->middleware('auth');

Route::get('/account', 'UserController@account')->name('account')->middleware('auth');

Route::post('/account/register', 'UserController@registerAccount')->name('register_account')->middleware('auth');

//home

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//social

Route::post('/social/login', 'UserController@socialLogin')->name('social_login');

//campaign

Route::post('/campaign/create', 'CampaignController@store')->name('campaign_create')->middleware('auth');

Route::post('/campaign/{id}/edit', 'CampaignController@update')->name('campaign_edit')->middleware('auth');

Route::post('/campaign/delete', 'CampaignController@remove')->name('campaign_delete')->middleware('auth');

Route::post('/campaign/close', 'CampaignController@close')->name('campaign_close')->middleware('auth');

Route::get('/join/{id}/{link}', 'CampaignController@join')->name('campaign_join')->middleware('auth');

Route::get('/campaign/{id}', 'CampaignController@index')->name('campaign')->middleware('auth');

//payments

Route::post('/{id}/campaign/{cid}/pay','PaymentController@pay')->name('pay')->middleware('auth');