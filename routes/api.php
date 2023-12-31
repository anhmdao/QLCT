<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

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

// User
Route::apiResource('/users', UserController::class);
Route::put('/users/update-profile/{id}', [UserController::class, 'update']);
Route::post('/register', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'login']);

Route::get('user/get-id', [UserController::class, 'getUserId']);

//Categories
Route::apiResource('/categories', CategoriesController::class);
Route::get('/categories/find-by-user/{id}', [CategoriesController::class, 'findByUserId']);
Route::get('/categories/find-by-status/{status}', [CategoriesController::class, 'findByStatus']);

Route::get('/categories/view/all', [CategoriesController::class, 'indexAll']);
Route::get('/categories/view/search', [CategoriesController::class, 'search']);

//Wallet
Route::apiResource('wallets', WalletController::class);
Route::get('wallets/find-by-user/{id}', [WalletController::class, 'findByUserId']);
Route::get('wallets/find-by-status/{id}', [WalletController::class, 'findByStatus']);
Route::put('wallets/update-status/{id}', [WalletController::class, 'updateStatus']);
Route::put('wallets/edit-money-type/{id}', [WalletController::class, 'updateMoneyType']);

Route::get('wallets/view/all', [WalletController::class, 'index']);
Route::get('wallets/view/search', [WalletController::class, 'search']);

//Transaction
Route::get('transactions/find-all-transaction/{id}', [TransactionController::class, 'findAllByRange']);

Route::apiResource('transactions', TransactionController::class);
Route::get('transactions/find-by-wallet/{id}', [TransactionController::class, 'findByWallet']);
Route::get('transactions/find-by-category/{id}', [TransactionController::class, 'findByCategory']);
Route::get('transactions/find-all-by-time/{id}/{status}', [TransactionController::class, 'findAllByMonth']);
Route::get('transactions/find-all-6-month/{id}/{status}', [TransactionController::class, 'findAllTransactionFor6Month']);

Route::get('transactions/index/chart', [TransactionController::class, 'indexChart']);
Route::get('transactions/spending/chart', [TransactionController::class, 'spendingChart']);
//Chart
