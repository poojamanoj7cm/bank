<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('register');
});
Route::get('viewregister',[RegisterController::class, 'viewregister'])->name('register');
Route::post('/viewregister', [RegisterController::class, 'insertregister'])->name('register');
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/home', [HomeController::class, 'index'])->name('home');

Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit');
Route::get('/deposit', [TransactionController::class, 'showDepositForm'])->name('deposit');


Route::post('/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw');
Route::get('/withdraw', [TransactionController::class, 'showWithdrawForm'])->name('withdraw');


Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer');
Route::get('/transfer', [TransactionController::class, 'showTransferForm'])->name('transfer');

Route::get('/statement', [TransactionController::class, 'statement'])->name('statement');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/test', [HomeController::class, 'index'])->name('test.index');
Route::post('/test', [HomeController::class, 'store'])->name('test.store');



