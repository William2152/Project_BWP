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

Route::prefix('/profile')->group(function () {
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

Route::prefix('tokosaya')->group(function () {
    Route::get('/', [TokoController::class, 'TokoSaya']);
    Route::get('/updatetoko', [TokoController::class, 'editToko']);
    Route::get('/tambahproduk', [TokoController::class, 'AddProductPage']);

    Route::post('/ubahtoko', [TokoController::class, 'UpdateToko']);
    Route::post('/addProduct', [TokoController::class, 'AddProduct']);
});


Route::get('/punyatoko', function () {
    return view('toko.tokoProductSaya');
});



Route::get('/userCart', function () {
    return view('User.userCart');
});

Route::get('/userCheckout', function () {
    return view('User.userCheckout');
});
Route::prefix('/')->group(function () {
    Route::get('/', [LoginRegisControler::class, "HomePage"]);
    Route::get('/loginPage', [LoginRegisControler::class, "LoginPage"]);
    Route::get('/registerPage', [LoginRegisControler::class, "RegisterPage"]);
    Route::post('/login', [LoginRegisControler::class, "Login"]);
    Route::post('/register', [LoginRegisControler::class, "Register"]);
    Route::get('/logout', [LoginRegisControler::class, "Logout"]);
    Route::get('/homePage', [LoginRegisControler::class, "homePageUser"]);
    Route::prefix('/shopping')->group(function () {
        Route::get('/electronic', [LoginRegisControler::class, "CategoryElectronic"]);
        Route::get('/clothes', [LoginRegisControler::class, "CategoryClothes"]);
        Route::get('/jewelry', [LoginRegisControler::class, "CategoryJewelry"]);
        Route::get('/medicine', [LoginRegisControler::class, "CategoryMedicine"]);
        Route::get('/shoes', [LoginRegisControler::class, "CategoryShoes"]);
        Route::get('/bag', [LoginRegisControler::class, "CategoryBag"]);
        Route::get('/book', [LoginRegisControler::class, "CategoryBook"]);
        Route::get('/cook', [LoginRegisControler::class, "CategoryCook"]);
        Route::get('/toys', [LoginRegisControler::class, "CategoryToys"]);
        Route::get('/pediatrics', [LoginRegisControler::class, "CategoryPediatric"]);
        Route::get('/headphone', [LoginRegisControler::class, "CategoryHeadphone"]);
        Route::get('/sport', [LoginRegisControler::class, "CategorySport"]);
        Route::get('/phone', [LoginRegisControler::class, "CategoryPhone"]);
        Route::get('/art', [LoginRegisControler::class, "CategoryArt"]);
        Route::get('/food', [LoginRegisControler::class, "CategoryFood"]);
        Route::get('/keyboard', [LoginRegisControler::class, "CategoryKeyboard"]);
        Route::get('/pets', [LoginRegisControler::class, "CategoryPets"]);
        Route::get('/garden', [LoginRegisControler::class, "CategoryGarden"]);
        Route::get('/furniture', [LoginRegisControler::class, "CategoryFurniture"]);
        Route::get('/music', [LoginRegisControler::class, "CategoryMusic"]);
    });
});

Route::get('/edittoko', function () {
    return view('toko.editToko');
});
