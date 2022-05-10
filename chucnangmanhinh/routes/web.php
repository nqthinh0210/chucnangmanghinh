<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\index;
use App\Http\Controllers\login_index;
use App\Http\Controllers\user;
use App\Http\Controllers\products;
use App\Http\Controllers\customer;

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

Route::get('/',[index::class,'trangchu']);
Route::get('/login',[login_index::class,'login_index']);
Route::get('/logout',[login_index::class,'logout_index']);

// User
Route::post('/login-user',[user::class,'check_user']);
Route::get('/show-user',[user::class,'show_user']);
Route::get('/unactive-user/{user_id}',[user::class,'unactive_user']);
Route::get('/active-user/{user_id}',[user::class,'active_user']);
Route::get('/delete-user/{user_id}',[user::class,'delete_user']);
Route::get('/take-user/{user_id}',[user::class,'take_user']);
Route::post('/edit-user/{user_id}',[user::class,'edit_user']);
Route::get('/add-user',[user::class,'add_user']);
Route::post('/save-user',[user::class,'save_user']);
Route::post('/timkiem',[user::class,'search']);

// Product
Route::get('/show-product',[products::class,'show_product']);
Route::get('/add-product',[products::class,'add_product']);
Route::post('/save-product',[products::class,'save_product']);
Route::get('/active-sanpham/{product_id}',[products::class,'active_product']);
Route::get('/unactive-sanpham/{product_id}',[products::class,'unactive_product']);
Route::get('/edit-sanpham/{product_id}',[products::class,'take_product']);
Route::post('/update-sanpham/{product_id}',[products::class,'update_product']);
Route::get('/delete-sanpham/{product_id}',[products::class,'delete_product']);
Route::post('/timkiem-product',[products::class,'search']);

// Customer
Route::get('/add-customer',[customer::class,'add_customer']);
Route::post('/save-customer',[customer::class, 'save_customer']);
Route::get('/show-customer',[customer::class,'show_customer']);
Route::get('/take-customer/{customer_id}',[customer::class,'take_customer']);
Route::post('/update-customer/{customer_id}',[customer::class,'edit_customer']);
Route::get('/active-customer/{customer_id}',[customer::class,'active_customer']);
Route::get('/unactive-customer/{customer_id}',[customer::class,'unactive_customer']);
Route::get('/delete-customer/{customer_id}',[customer::class,'delete_customer']);
Route::post('/timkiem-customer',[customer::class,'search']);














