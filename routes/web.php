<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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
$path = "App\Http\Controllers";

Route::get('/logout', $path."\Pages@logout")->name('logout');


Route::group(['middleware' => ['visitors']], function(){	
	Route::get("/", "App\Http\Controllers\Pages@roots")->name('/');
	Route::get("/view/{no}", "App\Http\Controllers\Pages@viewProduct")->name('view');
	Route::get("/shop", "App\Http\Controllers\Pages@shop")->name('shop');
	Route::get('/link/{name}', "App\Http\Controllers\Pages@link")->name('link');
});
Route::group(['middleware' => ['checkLoggedIn']], function(){	
	Route::get("/signin-signup", "App\Http\Controllers\Pages@signinSignup")->name('signinSignup');
	Route::post('/signin', "App\Http\Controllers\Pages@signIn")->name('signin');
	Route::post('/signup', "App\Http\Controllers\Pages@signUp")->name('signup');
});
Route::group(['middleware' => ['checkAdmin']], function(){	
	Route::get('/admin/dashboard', "App\Http\Controllers\Admin@dashboard")->name('dashboard');
	Route::get('/admin/productManagement/{id?}', "App\Http\Controllers\Admin@productManagement")->name('productManagement');
	Route::post('/getProduct', "App\Http\Controllers\Admin@getProduct")->name('getProduct');
	Route::post('/addProduct', "App\Http\Controllers\Admin@addProduct")->name('addProduct');
	Route::post('/editProduct', "App\Http\Controllers\Admin@editProduct")->name('editProduct');
	Route::post('/checkPNumber', "App\Http\Controllers\Admin@checkPNumber")->name('checkPNumber');
	Route::post('/deleteProduct', "App\Http\Controllers\Admin@deleteProduct")->name('deleteProduct');
	Route::get('/admin/userManagement', "App\Http\Controllers\Admin@userManagement")->name('userManagement');
	Route::get('/admin/salesManagement', "App\Http\Controllers\Admin@salesManagement")->name('salesManagement');
	Route::post('/shipItem', "App\Http\Controllers\Admin@shipItem")->name('shipItem');
	Route::post('/rejectItem', "App\Http\Controllers\Admin@rejectItem")->name('rejectItem');
	Route::post('/setAdmin', "App\Http\Controllers\Admin@setAdmin")->name('setAdmin');
	Route::post('/delUser', "App\Http\Controllers\Admin@delUser")->name('delUser');
});
Route::group(['middleware' => 'forbidden'], function() {
    Route::post('/ratings', "App\Http\Controllers\Pages@ratings")->name('ratings');
    Route::post('/addToCart', "App\Http\Controllers\Pages@addToCart")->name('addToCart');
	Route::get('/cart', "App\Http\Controllers\Pages@cart")->name('cart');
	Route::post('/removeItem', "App\Http\Controllers\Pages@removeItem")->name("removeItem");
	Route::get('/checkout', "App\Http\Controllers\Pages@checkout")->name("checkout");
	Route::post('/proceedCheckout', "App\Http\Controllers\Pages@proceedCheckout")->name("proceedCheckout");
	Route::get('/tracking/{tracking?}', "App\Http\Controllers\Pages@tracking")->name('tracking');
	Route::post('/cancelItem', "App\Http\Controllers\Pages@cancelItem")->name('cancelItem');
	Route::post('/delivered', "App\Http\Controllers\Pages@delivered")->name('delivered');
	Route::get('/notification', "App\Http\Controllers\Pages@notification")->name('notification');
	Route::get('/profile', "App\Http\Controllers\Pages@profile")->name('profile');
	Route::post('/changePass', "App\Http\Controllers\Pages@changePass")->name('changePass');
	Route::post('/changeInfo', "App\Http\Controllers\Pages@changeInfo")->name('changeInfo');
});
