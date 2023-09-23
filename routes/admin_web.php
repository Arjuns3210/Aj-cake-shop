<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('user/index');
});

Route::get("login", [LoginController::class, "index"]);
Route::post("loginData", [LoginController::class, "Login"]);
Route::post("saveUser", [LoginController::class, "saveUser"]);

//for order
Route::get("track_order", [OrderController::class, "trackOrder"]);

//for cake
Route::get('/cake_add', [CakeController::class, 'AddCake']);