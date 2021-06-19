<?php

use App\Http\Controllers\AuthController;
use App\Models\Items;
use App\Http\Controllers\ItemController;
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

/*
Route::post('/items','ItemController@store');
Route::put('/items','ItemController@update');
Route::delete('/items','ItemController@destroy');
*/

Route::group(['middleware'=>['api','checkpassword'] ],function (){

    //Route::get('/items/export/all', [ItemController::class,'export']);
    Route::post('/admin/login', [AuthController::class,'login_admin']);
    Route::post('/user/login', [AuthController::class,'login_user']);
    //Route::post('/admin/register', [AuthController::class,'admin_register']);

});
Route::group(['middleware'=>['api','checkpassword','auth.guard:admin-api'] ],function (){

    Route::apiResource('Items', ItemController::class);
    Route::get('/items/export/all', [ItemController::class,'export']);
    Route::post('/admin/logout', [AuthController::class,'admin_logout']);


});
Route::group(['middleware'=>['api','checkpassword','auth.guard:user-api'] ],function (){

    Route::post('/user/profile',function (){
            return  \Auth::user();

    } );


});
Route::middleware('auth:api')->get('', function (Request $request) {

    return $request->user();
});
