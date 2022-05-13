<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('category/exists', 'CategoryController@exists')->name('category.exist');
    Route::post('category/{id}/status', 'CategoryController@changeStatus')->name('category.status');
    Route::post('category/data-list', 'CategoryController@allCategory')->name('allcategory');
    Route::resource('category', 'CategoryController');

    Route::post('tag/allTag', 'TagController@alltag')->name('alltag');
    Route::get('tag-exist', 'TagController@exist')->name('tag.exist');
    Route::resource('tag', 'TagController');

    //home page using
    Route::get('projects/exists', 'ProjectController@exists')->name('projects.exists');
    Route::post('ckeditor/image_upload', 'ProjectController@upload')->name('upload');
    Route::post('projects/data-list', 'ProjectController@allProject')->name('allproject');
    Route::resource('projects', 'ProjectController');


    Route::get('posts/check_slug', 'PostController@checkslug')->name('checkslug');
    Route::get('/blogcategory', 'PostController@blogcategory')->name('blogcategory');
    Route::get('/blogtag', 'PostController@blogtag')->name('blogtag');
    Route::post('posts/allPost', 'PostController@allPost')->name('allpost');

    Route::resource('posts', 'PostController');

    Route::get('service/exists', 'ServiceController@exists')->name('service.exists');
    Route::post('service/{id}/status', 'ServiceController@changeStatus')->name('service.status');
    Route::post('service/data-list', 'ServiceController@dataListing')->name('service.list');
    Route::resource('service', 'ServiceController');

    Route::get('employee/exists', 'EmployeeController@exists')->name('employee.exists');
    Route::post('employee/{id}/status', 'EmployeeController@changeStatus')->name('employee.status');
    Route::post('employee/data-list', 'EmployeeController@dataListing')->name('employee.list');
    Route::resource('employee', 'EmployeeController');

    Route::post('about-us/data-list', 'AboutUsController@dataListing')->name('about-us.list');
    Route::resource('about-us', 'AboutUsController');

    Route::post('contact/data-list', 'ContactController@dataListing')->name('contact.list');
    Route::resource('contact', 'ContactController');

    Route::post('testimonials/{id}/status', 'TestimonialController@changeStatus')->name('testimonials.status');
    Route::get('testimonials/exists', 'TestimonialController@exists')->name('testimonials.exists');
    Route::post('testimonials/data-list', 'TestimonialController@dataListing')->name('testimonials.list');
    Route::resource('testimonials', 'TestimonialController');

    Route::post('sliders/dataListing', 'SliderController@dataListing')->name('sliders.list');
    Route::resource('sliders', 'SliderController');

    Route::group(['middleware' => []], function () {
        Route::get('website-setting', 'Settings\SettingController@showSettingPage')->name('website-setting');
        Route::resource('settings', 'Settings\SettingController');
        Route::resource('smtp', 'Settings\SmtpSettingController');
    });
});