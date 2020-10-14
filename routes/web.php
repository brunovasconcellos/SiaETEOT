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

//Routes referencess auth
Route::middleware(["guest"])->get("/login", "Auth\LoginController@showLoginForm")->name("login");

Route::middleware(["guest"])->post("/login", "Auth\LoginController@login");

Route::post("/logout", "Auth\LoginController@logout")->name("logout");

Route::middleware(["auth"])->get("/password/confirm", "Auth\ConfirmPasswordController@showConfirmForm")->name("password.confirm");

Route::middleware(["auth"])->post("/password/confirm", "Auth\ConfirmPasswordController@confirm");

Route::post("/password/email", "Auth\ForgotPasswordController@sendResetLinkEmail")->name("password.email");

Route::post("/password/reset", "Auth\ResetPasswordController@reset")->name("password.update");

Route::get("/password/reset", "Auth\ForgotPasswordController@showLinkRequestForm")->name("password.request");

Route::get("/password/reset/{token}", "Auth\ResetPasswordController@showResetForm")->name("password.reset");


Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(["auth"])->prefix("dashboard")->group(function () {

    Route::middleware(["employee"])->group(function () {

        Route::resource("/student", "Student\StudentController");

        Route::resource("/responsible", "Student\ResponsibleController");

        Route::resource('/employee', 'Employee\EmployeeController');      

        Route::put("/employee/{employeeId}/{exertsId}", "Employee\EmployeeController@update");

        Route::resource('/studentunit', 'StudentUnit\StudentUnitController');
        
        Route::resource('/transfersu', 'StudentUnit\TransferSusController');

        Route::resource('/schoolclass', 'Course\SchoolClassController');
   
        Route::resource("/disciplineschoolclass", "Course\DisciplineSchoolClassController");

        Route::resource('/course', 'Course\CourseController');

        Route::resource('/occupation', 'Employee\OccupationsController');

        Route::get('/occupationformated', 'Employee\OccupationsController@select2Data');

        Route::post('/occupationemployee/{employeId}', 'Employee\OccupationEmployeeController@store');

        Route::resource("/teach", "Employee\TeachController");
        
        Route::resource("/discipline", "Course\DisciplineController");
        
        Route::get("/disciplineformated", "Course\DisciplineController@select2Data");

        Route::resource('/position', 'Employee\PositionController');

        Route::resource('/exert', 'Employee\ExertsController');

    });

});

Route::resource('/coursediscipline', 'Course\CourseDisciplineController');

Route::resource('/able', 'Employee\AbleController');

Route::resource('/schedule', 'Course\SchedulesController');

Route::resource('/content', 'Course\ContentController');

Route::resource('/schoolreport', "Student\SchoolReportController");

Route::resource('/lesonstatus', 'Course\LesonStatusController');

Route::resource('/matriculated', "Course\MatriculatedController");

Route::resource("/lack", "Course\LackController");

Route::get("/course/all", "Course\CourseController@test");

Route::get("/studentexport", "Student\StudentController@export");

Route::get("/lte", function () {

    return view("lte");

});