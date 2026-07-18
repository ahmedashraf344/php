<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    // return redirect(\route('dashboard.v1.index'));
    return view('landing');
});

Route::get('/loginby/{id}', function ($id) {
    if (app()->environment() != 'local') return abort(404);
    Auth::loginUsingId($id);

    return redirect(route('dashboard.v1.index'));
});

Route::get('/test-code', function () {
    return bcrypt('password');
});

Route::group(['middleware' => ['auth', 'verified', 'check_permission', 'check_role'],
    'prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard.v1.index');
    })->name('v1.index');

    Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1'], function () {
        Route::resource('users', 'UserController');

        Route::resource('settings', 'SettingController');

        Route::resource('categories', 'CategoryController');

        Route::resource('files', 'FileCenterController')->only('destroy');

        Route::resource('shops', 'ShopController');
        Route::resource('comments', 'CommentController')->only( 'store', 'destroy');

        Route::resource('reviews', 'ReviewController');

        Route::resource('favourites', 'FavouriteController');

        Route::resource('announcements', 'AnnouncementController')->except('show');

        Route::resource('posts', 'PostController')->except('show');

        Route::resource('users', 'UserController')->except('create', 'store', 'show');

        Route::resource('contact-us-forms', 'ContactUsController')->only('index', 'edit', 'destroy');

        Route::resource('settings', 'SettingController')->only('edit', 'store');

        Route::resource('notification', 'NotificationController')->only('index' , 'create' , 'store' , 'destroy' );
        
        // competitions
        Route::get('competitions' , 'CompetitionController@index')->name('competition.index');
        Route::get('competitions/create', 'CompetitionController@create')->name('competition.create');
        Route::post('competitions/store', 'CompetitionController@store')->name('competition.store');
        Route::get('competitions/show/{competition_id}', 'CompetitionController@show')->name('competition.show');
        Route::get('competitions/edit/{competition_id}', 'CompetitionController@edit')->name('competition.edit');
        Route::put('competitions/update/{competition_id}', 'CompetitionController@update')->name('competition.update');
        Route::delete('competitions/delete/{competition_id}', 'CompetitionController@destroy')->name('competition.destroy');
        Route::get('competitions/status/{competition_id}', 'CompetitionController@status')->name('competition.status');
        Route::post('competitions/clear-data', 'CompetitionController@clearData')->name('competition.clear_data');

    });
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
