<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 


Route::middleware(['auth:sanctum'])->group(function() {
 
      Route::get('/ckeckingAuthenticated', function(){
            return response()->json(['message'=>'You are in', 'status'=>200], 200); 
      });
      Route::post('/logout', [AuthController::class, 'logout']);

});



//category
Route::get('/view-category', [CategoryController::class, 'index']);
Route::post('/store-category', [CategoryController::class, 'store']);
Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
Route::put('/update-category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);
Route::get('/all-category', [CategoryController::class, 'allCategory']);

//product
Route::get('/view-product', [ProductController::class, 'index']);
Route::post('/store-product', [ProductController::class, 'store']);
Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
Route::put('/update-product/{id}', [ProductController::class, 'update']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
Route::get('/all-product', [ProductController::class, 'allProduct']);


Route::get('/getCategory', [FrontendController::class, 'category']);
Route::get('/fetchProduct/{slug}', [FrontendController::class, 'product']);
Route::get('/product-detail/{category_slug}/{product_slug}', [FrontendController::class, 'viewProduct']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 

// Route::group([
//     'middleware'=> 'api',
//     'prefix' => 'auth',
// ], function($router) {

//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);   
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::get('/profile', [AuthController::class, 'profile']);

// });
