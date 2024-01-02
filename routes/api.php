<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\KuponController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

Route::prefix('profile')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('upload', [UserController::class, 'upload']);
    });

Route::prefix('garage')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('get', [GarageController::class, 'get']);
        Route::post('detail/{id}', [GarageController::class, 'detail']);
    });

Route::prefix('cart')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('store', [CartController::class, 'store']);
        Route::get('get', [CartController::class, 'get']);
        Route::post('delete', [CartController::class, 'destroy']);

    });

Route::prefix('transaction')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('list', [TransactionController::class, 'list']);

    });

Route::prefix('kupon')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('list', [KuponController::class, 'list']);

    });

Route::prefix('notification')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('list', [NotificationController::class, 'list']);
        Route::post('read/{id}', [NotificationController::class, 'read']);
        Route::delete('destroy/{id}', [NotificationController::class, 'destroy']);
    });
