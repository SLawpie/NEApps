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
    return view('welcome');
});

// Route::get('/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('welcome');
// });

// Route::get('/', 'HomeController@index')->name('home');

// Auth::routes([
//      'register' => false, // Registration Routes...
//      'reset' => false, // Password Reset Routes...
//      'verify' => false, // Email Verification Routes...
//    ]);

// Auth::routes();
Auth::routes([
     'register' => false,
     'reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/userSettings','User\UserController@showUserSettings')->name('user.settings');

Route::get('/history','User\UserController@showUserHistory')->name('user.history');
Route::get('/usersHistory', 'Admin\LogController@showUsersHistory')->name('admin.history')->middleware('can:manage-users');

Route::get('/changePassword','User\UserController@showChangePasswordForm')->name('password.change.form');
Route::post('/changePassword','User\UserController@changePassword')->name('password.change');

Route::get('/excel/test', 'MedReportController@test')->name('excel.test')->middleware('can:medical-reports');

Route::get('/medicalreports', 'MedReportController@index')->name('medical_reports.index')->middleware('can:medical-reports');

Route::get('/medicalreports/import', 'MedReportController@importFile')->name('medical_reports.import.file')->middleware('can:medical-reports');
Route::post('/medicalreports/import', 'MedReportController@importExcel')->name('medical_reports.import.excel')->middleware('can:medical-reports');
Route::get('/medicalreports/doctors/{sheet}', 'MedReportController@readSheet')->name('medical_reports.import.sheet')->middleware('can:medical-reports');

Route::get('/excel/import', 'MedReportController@importTestFile')->name('excel.import.file')->middleware('can:medical-reports');
Route::post('/excel/import', 'MedReportController@importTestExcel')->name('excel.import.excel')->middleware('can:medical-reports');

Route::get('/plasmacosts', 'Noelle\PlasmaCostsController@index')->name('plasma-costs.index')->middleware('can:plasma-costs');
Route::get('/plasmacosts/settings', 'Noelle\PlasmaCostsController@settingsFormShow')->name('plasma-costs.settings')->middleware('can:plasma-costs');

//Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['show', 'create', 'store']]);
//Dodanie Namespace
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
     Route::resource('/users','UsersController', ['except' => ['show', 'create', 'store']]);
});