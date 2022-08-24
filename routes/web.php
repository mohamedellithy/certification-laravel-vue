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
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false // Email Verification Routes...
]);


Route::middleware(['auth'])->group(function(){
    Route::get('departments/create/{parent_id?}','DepartmentController@create');
    Route::resource('departments','DepartmentController');
    Route::get('certifications/create/{department_id?}','CertificationController@create');
    Route::resource('certifications','CertificationController');
    Route::get('certifications/customize/create/{certification_id?}','CustomizeController@index');
    Route::post('save-customize-certification/{certification}'   ,'CustomizeController@save_customize');
    Route::post('destroy-image-certification','CertificationController@destroy_image');
    Route::resource('fonts','FontController');
    Route::resource('adsenses','AdsenseController');

    Route::get('reset_password','SettingController@reset_password')->name('admin_reset_password');
    Route::put('update_password','SettingController@update_password')->name('admin_update_password');
    
});


Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/show-departments','Front\DepartmentController@index')->name('front_show_departments');
Route::get('/{department:slug}','Front\DepartmentController@show')->name('front_single_department');
Route::get('/{department:slug}/{certification:slug}','Front\CertificationController@index')->name('front_single_certification');
Route::post('generate/certifications','Front\GenerateCertification@index');




Route::get('/create-section', function () {
    return view('admin.sections.create');
});

Route::get('/single-section/1', function () {
    return view('admin.sections.single');
});

Route::get('/single-section/2', function () {
    return view('admin.certifications.show');
});

Route::get('/single-certification/1', function () {
    return view('admin.certifications.single');
});

Route::get('/create-certification', function () {
    return view('admin.certification.create');
});

