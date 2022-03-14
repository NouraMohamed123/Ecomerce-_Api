<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\MangerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/////user
Route::post('/login',[userController::class,'login']);
Route::post('/register',[userController::class,'register']);

Route::group(['middleware' => 'auth:sanctum'] ,function(){


Route::get('/hello_world',[Controller::class,'hello_world']);
Route::post('/insert_manger',[MangerController::class,'insert']);
Route::get('/get_managers',[MangerController::class,'get_managers']);
Route::get('/get_manager/{id}',[MangerController::class,'get_manager']);
Route::put('/update_manager/{id}',[MangerController::class,'update_manager']);
Route::delete('/delete_manager/{id}',[MangerController::class,'delete_manager']);

/////////////mall
Route::post('/insert_mall',[MallController::class,'insert']);
Route::get('/get_malls',[MallController::class,'get_malls']);
Route::get('/get_mall/{id}',[MallController::class,'get_mall']);
Route::put('/update_mall/{id}',[MallController::class,'update_mall']);
Route::delete('/delete_mall/{id}',[MallController::class,'delete_mall']);
////department

Route::post('/insert_department',[DepartmentController::class,'insert']);
Route::get('/get_departments',[DepartmentController::class,'get_departments']);
Route::get('/get_department/{id}',[DepartmentController::class,'get_department']);
Route::put('/update_department/{id}',[DepartmentController::class,'update_department']);
Route::delete('/delete_department/{id}',[DepartmentController::class,'delete_department']);

/////////Vendor

Route::post('/insert_vendor',[VendorController::class,'insert']);
Route::get('/get_vendors',[VendorController::class,'get_vendors']);
Route::get('/get_vendor/{id}',[VendorController::class,'get_vendor']);
Route::put('/update_vendor/{id}',[VendorController::class,'update_vendor']);
Route::delete('/delete_vendor/{id}',[VendorController::class,'delete_vendor']);


/////////product

Route::post('/insert_product',[ProductController::class,'insert']);
Route::get('/get_products',[ProductController::class,'get_products']);
Route::get('/get_product/{id}',[ProductController::class,'get_product']);
Route::put('/update_product/{id}',[ProductController::class,'update_product']);
Route::delete('/delete_product/{id}',[ProductController::class,'delete_product']);
///vendorProduct

Route::post('/vendor_product',[VendorProductController::class,'insert']);

});

