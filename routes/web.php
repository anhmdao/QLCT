<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [HomeController::class,'login'])->name('login'); 
Route::get('/login', [HomeController::class,'login']);
Route::get('/register_view', [HomeController::class, 'register']);
Route::post('/login/view', [HomeController::class, 'login_home'])->name('login.home');
Route::post('/register/home', [HomeController::class, 'register_home']);

Route::get('/home', [AuthController::class,'index'])->name('home'); 

//Wallet
Route::get('/wallet', [WalletController::class,'wallet'])->name('wallet');
Route::post('/wallet/add', [WalletController::class, 'add_wallet'])->name('wallet.add');
Route::get('/wallet/edit/{wallet_id}', [WalletController::class, 'edit'])->name('wallet.edit');
Route::post('/wallet/update/{wallet_id}', [WalletController::class, 'update'])->name('wallet.update');
Route::delete('/wallet/destroy/{wallet_id}', [WalletController::class, 'delete'])->name('wallet.delete');

Route::get('/wallet/balance/{wallet_id}', [WalletController::class, 'show'])->name('wallet.balance');
Route::post('/wallet/add/balance{wallet_id}', [WalletController::class, 'add_balance'])->name('wallet.add.balance');
//Category

Route::get('/category', [CategoriesController::class,'category'])->name('category');

// Route::get('category/form/add', [CategoriesController::class, 'showForm'])->name('show.form');

Route::get('/category/edit/{category_id}', [CategoriesController::class, 'edit'])->name('category.edit');

Route::post('/category/update/{category_id}', [CategoriesController::class, 'update'])->name('category.update');

Route::delete('/category/destroy/{category_id}', [CategoriesController::class, 'delete'])->name('category.destroy');


Route::post('/category/add', [CategoriesController::class, 'add_category'])->name('category.add');

// Route::post('/category/edit', [CategoriesController::class, 'edit_category'])->name('category.edit');


//Transaction
Route::get('/transaction', [TransactionController::class,'transaction'])->name('transaction');
Route::post('/transaction/add', [TransactionController::class,'add_transaction'])->name('transaction.add');
Route::get('/transaction/edit/{transaction_id}', [TransactionController::class,'edit'])->name('transaction.edit');
Route::post('/transaction/update/{transaction_id}', [TransactionController::class,'update'])->name('transaction.update');
Route::delete('/transaction/delete/{transaction_id}', [TransactionController::class,'delete'])->name('transaction.delete');

Route::post('/transaction/search', [TransactionController::class,'search'])->name('transaction.search');






//Update Profile
Route::get('/profile', [AuthController::class,'updateForm']);

Route::get('/edit-profile', [AuthController::class, 'updateForm'])->name('profile.show');

Route::post('/edit-profile', [AuthController::class, 'updateInfor'])->name('profile.update');

// Auth::routes();
// Route::group(['middleware' => 'auth'], function () {
//     // All route your need authenticated
   
//Change password
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password.form');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');

    

    
    
// });
