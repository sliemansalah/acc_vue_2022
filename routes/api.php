<?php

use Illuminate\Support\Facades\Route;
use Acc\Seller\Items\Http\Controllers\ItemController;
use Acc\Seller\Rating\Http\Controllers\RatingController;
use Acc\Seller\Customers\Http\Controllers\CustomerController;
use Acc\Seller\Categories\Http\Controllers\CategoryController;
use Acc\Admin\ItemTypes\Http\Controllers\ItemTypeController;
use Acc\Seller\Coupons\Http\Controllers\CouponController;
use Acc\Admin\Countries\Http\Controllers\CountryController;
use Acc\Seller\Pages\Http\Controllers\PageController;
use Acc\Seller\Orders\Http\Controllers\OrderController;
use Acc\Seller\Stores\Http\Controllers\StoreController;
use Acc\Seller\ContactUs\Http\Controllers\ContactUsController;
use Acc\Admin\Activities\Http\Controllers\ActivityController;
use Acc\Admin\Groups\Http\Controllers\GroupController;
use Acc\Admin\ContactUs\Http\Controllers\AdminContactUsController;
use Acc\Admin\Auth\Http\Controllers\AuthController;


Route::post('/login', [\Acc\Seller\Auth\Http\Controllers\LoginController::class, 'login']);

Route::post('seller/store_login', [\Acc\Seller\Auth\Http\Controllers\LoginController::class, 'storeLogin']);


Route::prefix('seller')->middleware('auth:store')->group(function () {

    /** *************** category **************** */
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'find']);
        Route::post('/{id}', [CategoryController::class, 'update']);
        Route::put('/', [CategoryController::class, 'updateStatus']);
        Route::delete('/', [CategoryController::class, 'destroy']);
    });

    /** *************** item **************** */
    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/list_categories', [ItemController::class, 'listCategories']);
        Route::post('/', [ItemController::class, 'store']);
        Route::get('/{id}', [ItemController::class, 'find']);
        Route::post('/{id}', [ItemController::class, 'update']);
        Route::put('/', [ItemController::class, 'updateStatus']);
        Route::delete('/', [ItemController::class, 'destroy']);
    });

    /** *************** Rating **************** */
    Route::prefix('rate')->group(function () {
        Route::get('/', [RatingController::class, 'index']);
        Route::get('/list_customer', [RatingController::class, 'listCustomer']);
        Route::get('/list_item', [RatingController::class, 'listItem']);
        Route::post('/', [RatingController::class, 'store']);
        Route::get('/{id}', [RatingController::class, 'find']);
        Route::post('/{id}', [RatingController::class, 'update']);
        Route::put('/', [RatingController::class, 'updateStatus']);
        Route::delete('/', [RatingController::class, 'destroy']);

    });

    /** *************** customer **************** */
    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::post('/', [CustomerController::class, 'store']);
        Route::post('/store_many', [CustomerController::class, 'storeMany']);
        Route::get('/{id}', [CustomerController::class, 'find']);
        Route::post('/{id}', [CustomerController::class, 'update']);
        Route::put('/', [CustomerController::class, 'updateStatus']);
        Route::delete('/', [CustomerController::class, 'destroy']);
    });

    /** *************** coupon **************** */
    Route::prefix('coupon')->group(function () {
        Route::get('/', [CouponController::class, 'index']);
        Route::post('/', [CouponController::class, 'store']);
        Route::get('/{id}', [CouponController::class, 'find']);
        Route::post('/{id}', [CouponController::class, 'update']);
        Route::put('/', [CouponController::class, 'updateStatus']);
        Route::delete('/', [CouponController::class, 'destroy']);
    });

    /** *************** pages **************** */
    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'index']);
        Route::post('/', [PageController::class, 'store']);
        Route::get('/{id}', [PageController::class, 'find']);
        Route::post('/{id}', [PageController::class, 'update']);
        Route::put('/', [PageController::class, 'updateStatus']);
        Route::delete('/', [PageController::class, 'destroy']);
    });

    /** *************** order **************** */
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/status', [OrderController::class, 'getOrderStatus']);
        Route::get('/customer', [OrderController::class, 'getCustomer']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{id}', [OrderController::class, 'find']);
        Route::post('/{id}', [OrderController::class, 'update']);
        Route::put('/', [OrderController::class, 'updateStatus']);
        Route::delete('/', [OrderController::class, 'destroy']);
    });

    /** *************** store **************** */
    Route::prefix('store')->group(function () {
        Route::get('/', [StoreController::class, 'index']);
        Route::get('/data_dashboard', [StoreController::class, 'dataDashboard']);
        Route::get('/get_activities', [StoreController::class, 'getActivities']);
        Route::post('/', [StoreController::class, 'store']);
        Route::get('/{id}', [StoreController::class, 'find']);
        Route::post('/{id}', [StoreController::class, 'update']);
        Route::put('/', [StoreController::class, 'updateStatus']);
        Route::delete('/', [StoreController::class, 'destroy']);
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactUsController::class, 'index']);
        Route::post('/', [ContactUsController::class, 'store']);
        Route::get('/{id}', [ContactUsController::class, 'find']);
        Route::delete('/', [ContactUsController::class, 'destroy']);
    });


    Route::post('logout', [\Acc\Seller\Auth\Http\Controllers\LoginController::class, 'logout']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::post('login',[AuthController::class, 'login'])->withoutMiddleware('auth:admin');

    /** *************** itemType **************** */
    Route::prefix('item_type')->group(function () {
        Route::get('/', [ItemTypeController::class, 'index'])->withoutMiddleware('auth:admin');
        Route::get('/getAll', [ItemTypeController::class, 'getAll']);
        Route::post('/', [ItemTypeController::class, 'store']);
        Route::get('/{id}', [ItemTypeController::class, 'find']);
        Route::post('/{id}', [ItemTypeController::class, 'update']);
        Route::delete('/', [ItemTypeController::class, 'destroy']);
        Route::put('/', [ItemTypeController::class, 'updateStatus']);
    });

    /** *************** Country **************** */
    Route::prefix('country')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->withoutMiddleware('auth:admin');
        Route::get('/getAll', [CountryController::class, 'getAll']);
        Route::post('/', [CountryController::class, 'store']);
        Route::get('/{id}', [CountryController::class, 'find']);
        Route::post('/{id}', [CountryController::class, 'update']);
        Route::delete('/', [CountryController::class, 'destroy']);
        Route::put('/', [CountryController::class, 'updateStatus']);
    });

    /** *************** activity **************** */
    Route::prefix('activity')->group(function () {
        Route::get('/', [ActivityController::class, 'index']);
        Route::post('/', [ActivityController::class, 'store']);
        Route::get('/{id}', [ActivityController::class, 'find']);
        Route::post('/{id}', [ActivityController::class, 'update']);
        Route::delete('/', [ActivityController::class, 'destroy']);
        Route::put('/', [ActivityController::class, 'updateStatus']);
    });

    /** *************** dashboard **************** */
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [\Acc\Admin\Auth\Http\Controllers\DashBoardController::class, 'index']);
    });

    /** *************** Groups **************** */
    Route::prefix('group')->group(function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::get('/list_group', [GroupController::class, 'listGroup']);
        Route::post('/', [GroupController::class, 'store']);
        Route::get('/{id}', [GroupController::class, 'find']);
        Route::post('/{id}', [GroupController::class, 'update']);
        Route::delete('/', [GroupController::class, 'destroy']);
        Route::put('/', [GroupController::class, 'updateStatus']);
    });

    /** *************** Store **************** */
    Route::prefix('store')->group(function () {
        Route::get('/', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'index']);
        Route::post('/', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'store']);
        Route::get('/{id}', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'find']);
        Route::post('/{id}', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'update']);
        Route::delete('/', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'destroy']);
        Route::put('/', [\Acc\Admin\Stores\Http\Controllers\StoreController::class, 'updateStatus']);
    });

 /** *************** contact **************** */
    Route::prefix('admin_contact')->group(function () {
        Route::get('/', [AdminContactUsController::class, 'index']);
        Route::get('/{id}', [AdminContactUsController::class, 'find']);
        Route::delete('/', [AdminContactUsController::class, 'destroy']);
    });

    /** ****** logout******** */
    Route::post('logout', [AuthController::class, 'logout']);
});
