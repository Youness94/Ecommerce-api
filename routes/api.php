<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function() {
 
      Route::get('/ckeckingAuthenticated', function(){
            return response()->json(['message'=>'You are in', 'status'=>200], 200); 

            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
            Route::get('/profile', [AuthController::class, 'profile']);
});


});
Route::middleware('auth:api')->get('/user', function (Request $request) {
      return $request->user();
  });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 

Route::group([
      'middleware' => 'api',
      // 'prefix' => 'auth'
  
], function ($router) {
      
          Route::post('/logout', [AuthController::class, 'logout']);
          Route::post('/refresh', [AuthController::class, 'refresh']);
          Route::get('/profile', [AuthController::class, 'profile']);
      });
// //category
// Route::get('/view-category', [CategoryController::class, 'index']);
// Route::post('/store-category', [CategoryController::class, 'store']);
// Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
// Route::put('/update-category/{id}', [CategoryController::class, 'update']);
// Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);
// Route::get('/all-category', [CategoryController::class, 'allCategory']);



// // brand
// Route::get('/view-brand', [BrandController::class, 'index']);
// Route::post('/store-brand', [BrandController::class, 'store']);
// Route::get('/edit-brand/{id}', [BrandController::class, 'edit']);
// Route::put('/update-brand/{id}', [BrandController::class, 'update']);
// Route::delete('/delete-brand/{id}', [BrandController::class, 'destroy']);
// Route::get('/all-brand', [BrandController::class, 'allBrand']);


// //size
// Route::get('/view-size', [SizeController::class, 'index']);
// Route::post('/store-size', [SizeController::class, 'store']);
// Route::get('/edit-size/{id}', [SizeController::class, 'edit']);
// Route::put('/update-size/{id}', [SizeController::class, 'update']);
// Route::delete('/delete-size/{id}', [SizeController::class, 'destroy']);
// Route::get('/all-size', [SizeController::class, 'allSize']);

// //product
// Route::get('/view-product', [ProductController::class, 'index']);
// Route::post('/store-product', [ProductController::class, 'store']);
// Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
// Route::post('/update-product/{id}', [ProductController::class, 'update']);
// Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
// Route::get('/productById/{id}', [ProductController::class, 'show']);




Route::middleware(['cors'])->group(function () {

//category
Route::get('/view-category', [CategoryController::class, 'index']);
Route::post('/store-category', [CategoryController::class, 'store']);
Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
Route::put('/update-category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);
Route::get('/all-category', [CategoryController::class, 'allCategory']);



// brand
Route::get('/view-brand', [BrandController::class, 'index']);
Route::post('/store-brand', [BrandController::class, 'store']);
Route::get('/edit-brand/{id}', [BrandController::class, 'edit']);
Route::put('/update-brand/{id}', [BrandController::class, 'update']);
Route::delete('/delete-brand/{id}', [BrandController::class, 'destroy']);
Route::get('/all-brand', [BrandController::class, 'allBrand']);


//size
Route::get('/view-size', [SizeController::class, 'index']);
Route::post('/store-size', [SizeController::class, 'store']);
Route::get('/edit-size/{id}', [SizeController::class, 'edit']);
Route::put('/update-size/{id}', [SizeController::class, 'update']);
Route::delete('/delete-size/{id}', [SizeController::class, 'destroy']);
Route::get('/all-size', [SizeController::class, 'allSize']);

//product
Route::get('/view-product', [ProductController::class, 'index']);
Route::post('/store-product', [ProductController::class, 'store']);
Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
Route::post('/update-product/{id}', [ProductController::class, 'update']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
Route::get('/productById/{id}', [ProductController::class, 'show']);
});

Route::get('/all-product', [ProductController::class, 'allProduct']);
// Route::get('/getCategory', [FrontendController::class, 'category']);
// Route::get('/fetchProduct/{slug}', [FrontendController::class, 'product']);
// Route::get('/product-detail/{category_slug}/{product_slug}', [FrontendController::class, 'viewProduct']);

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']); 

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
