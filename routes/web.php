<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\KuponController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, '_login'])->name('login');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, '_register'])->name('register');
Route::get('/', [WebController::class, 'index']);
Route::get('/home', [WebController::class, 'index']);
Route::get('/contact', [WebController::class, 'contact']);

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::prefix('user')
    ->middleware('auth')
    ->group(function () {
        Route::get('profile', [UserController::class, 'index']);
        Route::patch('profile', [UserController::class, 'update'])->name('user.update');

        Route::get('garage', [GarageController::class, 'index']);
        Route::post('garage', [GarageController::class, 'store'])->name('garage.store');
        Route::patch('garage', [GarageController::class, 'update'])->name('garage.update');
        Route::get('garage/show/{id}', [GarageController::class, 'show']);
        Route::post('delete', [GarageController::class, 'destroy'])->name('garage.delete');

        Route::get('transaction', [TransactionController::class, 'index']);

        Route::get('kupon', [KuponController::class, 'index']);
        Route::post('kupon', [KuponController::class, 'store'])->name('kupon.store');

        Route::get('point', [PointController::class, 'index']);

        Route::get('notification', [NotificationController::class, 'index']);
    });

Route::prefix('cart')
    ->middleware('auth')
    ->group(function () {
        Route::post('store', [CartController::class, 'store']);
        Route::get('/', [CartController::class, 'index']);
    });

Route::prefix('checkout')
    ->middleware('auth')
    ->group(function () {
        Route::post('store', [CheckoutController::class, 'store'])->name('checkout.store');
    });
