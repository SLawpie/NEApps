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

Route::namespace('MedicalReports')->prefix('medicalreports')->name('medical_reports.')->middleware('can:medical-reports')->group(function(){
     Route::get('/', 'MRController@index')->name('index');
     Route::get('/import', 'MRController@importFile')->name('import.file');
     Route::post('/import', 'MRController@importExcel')->name('import.excel');
     Route::get('/doctors/{sheet}', 'MRController@readSheet')->name('import.sheet');
     Route::get('/pricelist', 'PriceListController@priceList')->name('pricelist');
     Route::get('/pricelist/actionGet', 'PriceListController@actionGet')->name('pricelist.actionGet');
     Route::post('/pricelist/action', 'PriceListController@action')->name('pricelist.action');
});

Route::get('/excel/test', 'MedicalReports\MRController@test')->name('excel.test')->middleware('can:medical-reports');
Route::get('/excel/import', 'MedicalReports\MRController@importTestFile')->name('excel.import.file')->middleware('can:medical-reports');
Route::post('/excel/import', 'MedicalReports\MRController@importTestExcel')->name('excel.import.excel')->middleware('can:medical-reports');

Route::namespace('PlasmaCosts')->prefix('plasmacosts')->name('plasma-costs.')->middleware('can:plasma-costs')->group(function(){
     Route::get('/', 'PlasmaCostsController@index')->name('index');
     Route::get('/settings', 'PlasmaCostsController@settingsFormShow')->name('settings');
});

//Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['show', 'create', 'store']]);
//Dodanie Namespace
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
     Route::resource('/users','UsersController', ['except' => ['show', 'create', 'store']]);
});