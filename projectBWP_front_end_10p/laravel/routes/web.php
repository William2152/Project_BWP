<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KurirController;
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

Route::post('search/{text}', [LoginRegisControler::class, 'search']);

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
    Route::post('/liattoko/tentangtoko/{toko_id}', [TokoController::class, "TentangToko"]);
    Route::get('/liattoko/tentangtoko/{toko_id}', [TokoController::class, "TentangToko"]);
});

//kurir
Route::prefix('/kurir')->group(function () {
    Route::get('/daftar', [KurirController::class, 'registerKurir']);
    Route::get('/admin', [KurirController::class, 'kehalamanadminkurir']);
    Route::get('/home', [KurirController::class, 'kehalamanhomekurir']);
    Route::post('/register', [KurirController::class, 'register']);
});

//admin
Route::prefix('admin')->middleware(['cekRole:Admin'])->group(function () {
    Route::get('/user', [LoginRegisControler::class, 'AdminPage']);
    Route::get('/store', [AdminController::class, 'kehalamanstore']);
    Route::get('/history', [AdminController::class, 'kehalamanhistory']);
    Route::post('/store/terima', [AdminController::class, 'buatstoreberhasil']);
    Route::get('/voucher', [AdminController::class, 'VoucherPage']);
    // Route::post('/store/tolak', [AdminController::class, 'buatstoregagal']);
    Route::get('/topup', [AdminController::class, 'kehalamanacc']);
    Route::post('/topup/berhasil', [AdminController::class, 'topupberhasil']);
    Route::post('/topup/gagal', [AdminController::class, 'topupgagal']);
    Route::post('/user/delete', [AdminController::class, 'userDelete']);
    Route::post('/voucher/add', [AdminController::class, 'addvoucher']);
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
    Route::get('/userCart', [ProfileUser::class, 'Cart']);
    Route::post('/userCart/add', [ProfileUser::class, 'ProsesCart']);
    Route::post('/userCart/delete', [ProfileUser::class, 'DeleteCart']);
    Route::get('/userCheckout', [ProfileUser::class, 'CheckOut']);
    Route::get('/vouchersaya', [ProfileUser::class, 'Voucher']);
    Route::get('/formtoko', [ProfileUser::class, 'BuatToko']);

    Route::get('/saldosaya', [ProfileUser::class, 'Saldo']);
    Route::get('/saldosaya/history/topup', [ProfileUser::class, 'historytopup']);
    Route::get('/saldosaya/history/pembelian', [ProfileUser::class, 'historypembelian']);

    Route::post('/reqTopup', [ProfileUser::class, 'ReqTopup']);
    Route::post('/ubahProfile', [ProfileUser::class, 'ubahProfile']);
    Route::post('/ubahPass', [ProfileUser::class, 'ubahProfilePass']);
    Route::post('/tambahtoko', [ProfileUser::class, 'TambahToko']);
    Route::post('/prosesCheckout', [ProfileUser::class, 'prosesCheckOut']);
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
