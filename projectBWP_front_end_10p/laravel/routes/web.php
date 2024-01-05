<?php

use App\Http\Controllers\LoginRegisControler;
use App\Http\Controllers\ProfileUser;
use App\Http\Controllers\TokoController;
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



Route::get('/itemPage/{id}', [TokoController::class, 'itemPage']);
Route::get('/edit/{id}', [LoginRegisControler::class, 'EditProduct']);
Route::post('/edit/request', [TokoController::class, 'EditProduct']);

//umum
Route::prefix('/')->group(function () {
    Route::get('/', [LoginRegisControler::class, "HomePage"]);
    Route::get('/loginPage', [LoginRegisControler::class, "LoginPage"]);
    Route::get('/registerPage', [LoginRegisControler::class, "RegisterPage"]);
    Route::post('/login', [LoginRegisControler::class, "Login"]);
    Route::post('/register', [LoginRegisControler::class, "Register"]);
    Route::get('/logout', [LoginRegisControler::class, "Logout"]);
    Route::get('/homePage', [LoginRegisControler::class, "homePageUser"])->middleware(['cekRole:Customer,storeOwner']);
    Route::prefix('/shopping')->group(function () {
        Route::get('/{category}', [LoginRegisControler::class, "Category"]);
    });
    Route::post('/liattoko/produk/{toko_id}', [TokoController::class, "ProdukToko"]);
    Route::get('/liattoko/produk/{toko_id}', [TokoController::class, "ProdukToko"]);
});

//admin
Route::prefix('admin')->middleware(['cekRole:Admin'])->group(function () {
    Route::get('/', [LoginRegisControler::class, 'AdminPage']);
});

//profile user
Route::prefix('/profile')->middleware(['cekRole:Customer,storeOwner'])->group(function () {
    Route::get('/detail', [ProfileUser::class, 'Profile']);
    Route::get('/ubahpw', [ProfileUser::class, 'ProfilePass']);
    Route::prefix('/pesanansaya')->group(function () {
        Route::get('/belumdikirim', [ProfileUser::class, 'belumdikirim']);
        Route::get('/sedangdikirim', [ProfileUser::class, 'sedangdikirim']);
        Route::get('/selesai', [ProfileUser::class, 'selesai']);
    });
    Route::get('/vouchersaya', [ProfileUser::class, 'Voucher']);
    Route::get('/formtoko', [ProfileUser::class, 'BuatToko']);

    Route::get('/saldosaya', [ProfileUser::class, 'Saldo']);
    Route::get('/saldosaya/history/topup', [ProfileUser::class, 'historytopup']);
    Route::get('/saldosaya/history/pembelian', [ProfileUser::class, 'historypembelian']);
    Route::post('/ubahProfile', [ProfileUser::class, 'ubahProfile']);
    Route::post('/ubahPass', [ProfileUser::class, 'ubahProfilePass']);
    Route::post('/tambahtoko', [ProfileUser::class, 'TambahToko']);
});

//store owner toko
Route::get('/tokosaya', [TokoController::class, 'TokoSaya'])->middleware(['cekRole:Customer,storeOwner']);
Route::prefix('tokosaya')->middleware(['cekRole:storeOwner'])->group(function () {
    Route::get('/updatetoko', [TokoController::class, 'editToko']);
    Route::get('/tambahproduk', [TokoController::class, 'AddProductPage']);
    Route::post('/ubahtoko', [TokoController::class, 'UpdateToko']);
    Route::post('/addProduct', [TokoController::class, 'AddProduct']);
});


Route::get('/userCart', function () {
    return view('User.userCart');
});

Route::get('/userCheckout', function () {
    return view('User.userCheckout');
});
