<?php
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
Route::apiResource('Items', ItemController::class);

/*
Route::post('/items','ItemController@store');
Route::put('/items','ItemController@update');
Route::delete('/items','ItemController@destroy');
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
