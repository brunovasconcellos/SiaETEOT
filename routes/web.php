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

Route::get("/index", function() {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(["auth"])->prefix("dashboard")->group(function () {

    Route::middleware(["employee"])->prefix("employee")->group(function () {

        Route::resource("inspectorate", "Employee\InspectorController");

    });

});

//vew retorna password reset para mexer css dela
Route::get("/viewspassword", function () {

   return view("auth.passwords.reset");

});

