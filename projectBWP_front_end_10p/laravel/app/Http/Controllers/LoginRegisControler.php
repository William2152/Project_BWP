<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisControler extends Controller
{
    public function LoginPage(Request $req)
    {
        return view('loginPage');
    }

    public function RegisterPage(Request $req)
    {
        return view('registerPage');
    }

    public function Logout(Request $req)
    {
        if (Auth::guard("web")->check()) {
            Auth::guard("web")->logout();
        }
        return redirect("/");
    }

    public function Login(Request $req)
    {
        $credential = [
            "user_name" => $req->username,
            "password" => $req->password,
        ];

        if (Auth::guard("web")->attempt($credential)) {
            $user = Auth::guard("web")->user();
            if ($user->user_role == "Admin") {
                return view('adminPage', ["curr" => $user]);
            } else if ($user->user_role == "Customer") {
                return view('homePage', ["curr" => $user]);
            } else if ($user->user_role == "StoreOwner") {
                return view('homePage', ["curr" => $user]);
            }
        } else {
            return redirect('/loginPage')->with('err', 'gagal login!');
        }
    }

    public function Register(Request $req)
    {
        $result = Users::create([
            "user_email" => $req->user_email,
            "user_password" => Hash::make($req->user_password),
            "user_name" => $req->user_name,
            "user_nama" => $req->user_nama,
            "user_role" => $req->user_role,
        ]);

        if ($result) {
            return redirect('/')->with('success', 'berhasil register!');
        } else {
            return back()->with('error', 'gagal register!');
        }
    }
}
