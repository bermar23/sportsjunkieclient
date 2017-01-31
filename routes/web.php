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

Route::group(['middleware' => 'auth'], function () {

    /**
     * Profile
     */
    Route::get('/profile', 'ProfileController@index');

    /**
     * Dashboard
     */
    Route::get('/dashboard', 'DashboardController@index');

    /**
     * Calendar
     */
    Route::get('/calendar', 'CalendarController@index');

    /**
     * Outlet
     */
    Route::get('/outlet', 'OutletController@index');

    Route::get('/outlet/new', 'OutletController@create');

    Route::get('/outlet/show/{id}', 'OutletController@show');

    Route::get('/outlet/dataTableData', 'OutletController@dataTableData');

    Route::post('/outlet/store', 'OutletController@store');

    Route::post('/outlet/update', 'OutletController@update');

    Route::post('/outlet/destroy', 'OutletController@destroy');

    Route::get('/outlet/page/new/{id}', 'OutletController@new_page');

    Route::post('/outlet/page/store', 'OutletController@store_page');


    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

