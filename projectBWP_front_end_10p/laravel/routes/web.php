<?php

use App\Http\Controllers\LoginRegisControler;
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
    Route::get('/detail', function () {
        return view('user.profileDetail');
    });
    Route::get('/ubahpw', function () {
        return view('user.profilePassword');
    });
});
Route::get('/tokosaya', function () {
    return view('toko.gakpunyatoko');
});

Route::get('/punyatoko', function () {
    return view('toko.tokoProductSaya');
});

Route::get('/formtoko', function () {
    return view('toko.tambahToko');
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

Route::get('/pesanansaya', function () {
    return view('user.pesananSaya');
});

Route::get('/vouchersaya', function () {
    return view('user.voucherSaya');
});

Route::get('/saldosaya', function () {
    return view('user.saldoSaya');
});
