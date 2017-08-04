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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/trip/create', 'TripController@createTrip');
Route::get('/user/detail-info/{id}','UserController@info')->name('info');
Route::get('/user/edit/{id}','UserController@edit');
Route::post('/user/edit/{id}','UserController@postedit');
Route::get('/trip/detail/{trip_id}','TripController@detail');
Route::post('/trip/detail/{trip_id}','TripController@postdetail');
Route::get('/trip/delete/{id}','TripController@delete');
// public function auth()
//     {
//         // Authentication Routes...
//         $this->get('login', 'Auth\AuthController@showLoginForm');
//         $this->post('login', 'Auth\AuthController@login');
//         $this->get('logout', 'Auth\AuthController@logout');

//         // Registration Routes...
//         $this->get('register', 'Auth\AuthController@showRegistrationForm');
//         $this->post('register', 'Auth\AuthController@register');

//         // Password Reset Routes...
//         $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
//         $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
//         $this->post('password/reset', 'Auth\PasswordController@reset');
// }