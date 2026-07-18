<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1/auth', 'namespace' => 'Api'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    // Route::post('activate-account', 'AuthController@activateAccount');
    Route::post('resend-code', 'AuthController@resendCode');
    Route::post('forget-password', 'AuthController@forgetPassword');
    Route::post('check-forget-password-code', 'AuthController@checkForgetPasswordCode');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('update-profile', 'AuthController@updateProfile')->name('api.profile');
    Route::post('change-password', 'AuthController@changePassword');
    Route::post('update-device-token', 'AuthController@updateDeviceToken');
});

Route::group(['middleware' => ['jwt.auth', 'jwt'], 'prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    Route::get('categories/select-category-list', 'CategoryController@selectCategoryList');

    Route::resource('shops', 'ShopController')->only('store');

    Route::resource('favourites', 'FavouriteController')->only('index', 'store');

    Route::resource('reviews', 'ReviewController')->only('index', 'store');

    Route::resource('announcements', 'AnnouncementController')->only('index', 'show');

    Route::resource('posts', 'PostController')->except('destroy', 'edit', 'update');
    Route::resource('comments', 'CommentController')->only('store', 'destroy');
    Route::resource('reactions', 'ReactionController')->only('store');

    Route::resource('contact-us', 'ContactUsController')->only('store');

    Route::resource('settings', 'SettingController')->only('show');
    
    Route::post('competition/register-number', 'CompetitionController@registerNumber');

    Route::get('competition/show', 'CompetitionController@show');

    Route::resource('shops', 'ShopController')->only('index', 'show');
    Route::get('/home', 'HomeController@home');

    Route::post('/delete-account' , 'UserController@deleteAccount');

});

Route::group( ['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::get('competition/guest-show', 'CompetitionController@guestShow');

    Route::get('terms',  'HomeController@getTerms');

    Route::get('about-us',  'HomeController@getAboutUs');

    Route::get('notifications-count',  'HomeController@getNotificationsCount');

    Route::get('notifications',  'HomeController@getNotifications');

    Route::resource('categories', 'CategoryController')->only('index', 'show');

    Route::get('shops-guest', 'ShopController@index');
    Route::get( 'shops-guest/{shopId}' , 'ShopController@show');

    Route::resource('comments', 'CommentController')->only('index');

    Route::get('/home-guest', 'HomeController@home');

    Route::get('/', 'HomeController@home');


});