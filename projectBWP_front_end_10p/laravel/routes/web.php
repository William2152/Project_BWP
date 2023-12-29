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
    return view('homePage');
});

Route::get('/itemPage', function () {
    return view('itemPage');
});

Route::prefix('/')->group(function () {
    Route::get('/loginPage', [LoginRegisControler::class, "LoginPage"]);
    Route::get('/registerPage', [LoginRegisControler::class, "RegisterPage"]);
    Route::post('/login', [LoginRegisControler::class, "Login"]);
    Route::post('/register', [LoginRegisControler::class, "Register"]);
    Route::get('/logout', [LoginRegisControler::class, "Logout"]);
});
