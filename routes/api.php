<?php

use App\Http\Controllers\Api\{
    LaundryController,
    PromoController,
    ShopController,
    UserController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'readAll'])->name('index');
});

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'readAll'])->name('index');
});

Route::prefix('promo')->name('promo.')->group(function () {
    Route::get('/', [PromoController::class, 'readAll'])->name('index');
});

Route::prefix('laundry')->name('laundry.')->group(function () {
    Route::get('/', [LaundryController::class, 'readAll'])->name('index');
});

Route::middleware('auth:sanctum')->group(function () {
    // Promo
    Route::get('/laundry/user/{id}', [LaundryController::class, 'whereUserId'])->name('laundry-user');
    Route::post('/laundry/claim', [LaundryController::class, 'claim'])->name('laundry-claim');

    // Promo
    Route::get('/promo/limit', [PromoController::class, 'readLimit'])->name('promo-limit');

    // Shop
    Route::get('/shop/recommendation/limit', [ShopController::class, 'readRecommendationLimit'])->name('shop-recommendation');
    Route::get('/shop/search/city/{name}', [ShopController::class, 'searchByCity'])->name('shop-seacrh-city');
});
