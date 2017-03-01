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



// V1 API routes...
Route::group(['prefix' => 'api/v1'], function () {

    // get outlets
    Route::get('/outlets/{id?}', function($id = null) {
        $fields = array('id', 'code', 'name', 'description', 'coordinates');
        if ($id == null) {
            $outlets = App\Outlet::all($fields);
        } else {
            $outlets = App\Outlet::find($id, $fields);
        }
        return Response::json(array(
            'error' => false,
            'outlets' => $outlets,
            'status_code' => 200
        ));
    });

    // store outlets
    Route::post('/outlets/store', function(Request $request) {

        $outlet = new App\Outlet;
        $outlet->code = $outlet->getNewCode();
        $outlet->name = $request->name;
        $outlet->coordinates = $request->coordinates;
        $outlet->description = $request->description;
        $outlet->created_by = session('user_id');
        $outlet->save();

        return Response::json(array(
            'error' => false,
            'status_code' => 200
        ));
    });

    // update outlets
    Route::post('/outlets/update', function(Request $request) {

        $outlet = Outlet::find($request->id);
        $outlet->code = $request->code;
        $outlet->name = $request->name;
        $outlet->coordinates = $request->coordinates;
        $outlet->description = $request->description;
        $outlet->updated_by = session('user_id');
        $outlet->save();

        return Response::json(array(
            'error' => false,
            'status_code' => 200
        ));
    });

});
