<?php

use App\Http\Controllers\LoginRegisControler;
use App\Http\Controllers\ProfileUser;
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

Route::get('/', function () {
    return view('menu.homePage');
});

Route::get('/itemPage', function () {
    return view('menu.itemPage');
});

Route::prefix('/profile')->group(function () {
    Route::get('/detail', [ProfileUser::class, 'Profile']);
    Route::get('/ubahpw', [ProfileUser::class, 'ProfilePass']);
    Route::get('/pesanansaya', [ProfileUser::class, 'Pesanan']);
    Route::get('/vouchersaya', [ProfileUser::class, 'Voucher']);
    Route::get('/tokosaya', [ProfileUser::class, 'TokoSaya']);

    Route::get('/formtoko', [ProfileUser::class, 'BuatToko']);
    Route::get('/updatetoko', [ProfileUser::class, 'editToko']);
    Route::get('/saldosaya', [ProfileUser::class, 'Saldo']);
    Route::post('/ubahProfile', [ProfileUser::class, 'ubahProfile']);
    Route::post('/ubahPass', [ProfileUser::class, 'ubahProfilePass']);
    Route::post('/tambahtoko', [ProfileUser::class, 'TambahToko']);
    Route::post('/ubahtoko', [ProfileUser::class, 'UpdateToko']);
});
Route::get('/tokosaya', function () {
    return view('toko.gakpunyatoko');
});

Route::get('/punyatoko', function () {
    return view('toko.tokoProductSaya');
});

Route::get('/tambahproduk', function () {
    return view('menu.tambahProduct');
});



Route::prefix('/')->group(function () {
    Route::get('/loginPage', [LoginRegisControler::class, "LoginPage"]);
    Route::get('/registerPage', [LoginRegisControler::class, "RegisterPage"]);
    Route::post('/login', [LoginRegisControler::class, "Login"]);
    Route::post('/register', [LoginRegisControler::class, "Register"]);
    Route::get('/logout', [LoginRegisControler::class, "Logout"]);
    Route::get('/homePage', [LoginRegisControler::class, "homePageUser"]);
});

Route::get('/edittoko', function () {
    return view('toko.editToko');
});
