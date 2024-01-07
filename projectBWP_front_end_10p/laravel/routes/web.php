<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
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
Route::prefix('adminKurir')->middleware(['cekRole:AdminKurir'])->group(function () {
    Route::get('/', [KurirController::class, 'kehalamanadminkurir']);
    Route::post('/assign', [KurirController::class, 'assignKurir']);
});

Route::prefix('/kurir')->group(function () {
    Route::get('/daftar', [KurirController::class, 'registerKurir']);
    Route::post('/register', [KurirController::class, 'register']);
});

Route::prefix('/kurir')->middleware(['cekRole:Kurir'])->group(function () {
    Route::get('/home', [KurirController::class, 'kehalamanhomekurir']);
    Route::post('/terima', [KurirController::class, 'terima']);
});

//admin
Route::prefix('admin')->middleware(['cekRole:Admin'])->group(function () {
    Route::get('/user', [LoginRegisControler::class, 'AdminPage']);
    Route::get('/historypesanan', [AdminController::class, 'kehalamanhistorypesanan']);
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
    Route::post('/filter/{id}', [AdminController::class, 'kehalamanhistorypesananfilter']);
    Route::post('/export', [ExportController::class, 'export']);
});

//profile user
Route::prefix('/profile')->middleware(['cekRole:Customer,storeOwner'])->group(function () {
    Route::get('/detail', [ProfileUser::class, 'Profile']);
    Route::get('/ubahpw', [ProfileUser::class, 'ProfilePass']);
    Route::prefix('/pesanansaya')->group(function () {
        Route::get('/belumdiproses', [ProfileUser::class, 'belumdikirim']);
        Route::get('/menunggukurir', [ProfileUser::class, 'menungguKurir']);
        Route::get('/sedangdikirim', [ProfileUser::class, 'sedangdikirim']);
        Route::post('/sedangdikirim/selesai', [ProfileUser::class, 'sedangdikirimselesai']);
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
    Route::get('/saldosaya/history/pembelian/detail/{id}', [ProfileUser::class, 'detailpembelian']);

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
    Route::get('/pesanan', [TokoController::class, 'kehalamanacc']);
    Route::get('/pesanan/detail/{order_id}', [TokoController::class, 'kehalamandetail']);
    Route::get('/historypesanan', [TokoController::class, 'kehalamanhistorypesanan']);
    Route::get('/tarik', [TokoController::class, 'kehalamantarik']);
    Route::post('/tarik/revenue', [TokoController::class, 'tarik']);
    Route::post('/ubahtoko', [TokoController::class, 'UpdateToko']);
    Route::post('/addProduct', [TokoController::class, 'AddProduct']);
    Route::post('/acc', [TokoController::class, 'terima']);
    Route::get('/edit/{id}', [TokoController::class, 'EditProductPage']);
    Route::post('/edit/request', [TokoController::class, 'EditProduct']);
});


Route::get('/userCart', function () {
    return view('User.userCart');
});

Route::get('/userCheckout', function () {
    return view('User.userCheckout');
});
