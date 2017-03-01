<?php

use Illuminate\Http\Request;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes

});

// V1 API routes...
Route::group(['prefix' => 'v1', 'middleware' => 'auth.basic'], function () {

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
*/

// V1 API routes...
Route::group(['prefix' => 'api/v2'/*, 'middleware' => 'auth'*/], function () {

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