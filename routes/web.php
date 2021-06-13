<?php

use App\Http\Controllers\ItemController;
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
//Route::get('/items/export/all', [ItemController::class,'export']);
//Route::post('/items/import', [ItemController::class,'import']);
Route::get('/items/export/all', [ItemController::class,'export']);
Route::get('/items/import', [ItemController::class,'import']);

Route::get('/', function () {
    return view('welcome');
});
