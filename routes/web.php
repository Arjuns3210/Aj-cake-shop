<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
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
Route::get("/", [MainController::class, "index"]);
Route::get("city", [CityController::class, "index"]);

Route::get("login", [LoginController::class, "index"]);
Route::post("loginData", [LoginController::class, "Login"]);
Route::post("saveUser", [LoginController::class, "saveUser"]);
Route::get("searchCake", [MainController::class, "searchCake"]);

Route::group(['middleware'=>'web'],function(){
		Route::get('myAccount',[MainController::class,'myAccount']);
		Route::post('saveAddress/{id?}',[MainController::class,'saveAddress']);
		Route::get('address_edit/{id}',[MainController::class,'addressEdit']);
		Route::get('address_delete/{id}',[MainController::class,'addressDelete']);

		//for order
		Route::get("track_order", [OrderController::class, "trackOrder"]);
		Route::post("orderSave", [OrderController::class, "orderSave"]);

		//for cake
		Route::get('/cake_add', [CakeController::class, 'AddCake']);
		Route::post('/saveCake', [CakeController::class, 'saveCake']);

		//view cakes
		Route::get('/cake/{seo_url}', [CakeController::class, 'customCakeView']);
		Route::get('sortingCake', [CakeController::class,'sortingCake'])->name('sortingCake');

		//for cake buy
		Route::get('buy/{seo_url}',[CakeController::class, 'cakeBuy']);


		//for category
		Route::post('/saveCategory', [CakeController::class, 'saveCategory']);

		//for cart
		Route::get('/cart',[CartController::class,'index']);
		Route::post('/addToCart',[CartController::class,'addToCart']);
		Route::post('/cart/update/{id}/{val}/{price}',[CartController::class,'updateCart']);
		Route::get('/deleteCart/{id}',[CartController::class,'deleteCart']);
		Route::get('/checkout',[CartController::class,'checkout']);

});
Route::get('/logout',function(){
	Session::flush();
    return Redirect::to('/');
});