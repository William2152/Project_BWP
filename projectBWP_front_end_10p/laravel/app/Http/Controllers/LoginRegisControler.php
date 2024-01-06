<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisControler extends Controller
{
    public function HomePage(Request $req)
    {
        $product = Product::all();
        return view('menu.HomePage', [
            "product" => $product,
            "category" => "Rekomendasi",
        ]);
    }

    public function AdminPage(Request $req)
    {
        $user = Auth::guard("web")->user();
        $users = Users::all();
        return view('admin.user', ["curr" => $user, "user" => $users]);
    }



    public function LoginPage(Request $req)
    {
        return view('menu.loginPage');
    }

    public function RegisterPage(Request $req)
    {
        return view('menu.registerPage');
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
        $req->validate(
            [
                "username" => "required",
                "password" => "required",

            ],
            [
                "username.required" => "username tidak boleh kosong!",
                "password.required" => "password tidak boleh kosong!",
            ]
        );
        $credential = [
            "user_name" => $req->username,
            "password" => $req->password,
        ];

        if (Auth::guard("web")->attempt($credential)) {
            $user = Auth::guard("web")->user();
            if ($user->user_role == "Admin") {
                return redirect("/admin/user");
            } else if ($user->user_role == "Customer") {
                return redirect('/homePage');
            } else if ($user->user_role == "storeOwner") {
                return redirect('/homePage');
            }
        } else {
            return redirect('/loginPage')->with('err', 'gagal login!');
        }
    }

    public function Register(Request $req)
    {
        $req->validate(
            [
                "user_nama" => "required|",
                "user_name" => "required",
                "user_email" => "required|email",
                "user_phone" => "required|min:10|regex:/^[0-9]+(-[0-9]+)*$/",
                "user_gender" => "required",
                "user_password" => "required|min:8",
                "password_confirmation" => "required|same:user_password",

            ],
            [
                "user_nama.required" => "nama tidak boleh kosong!",
                "user_name.required" => "username tidak boleh kosong!",
                "user_email.required" => "email tidak boleh kosong!",
                "user_email.email" => "email harus berbentuk email!",
                "user_phone.required" => "nomor telepon tidak boleh kosong!",
                "user_phone.min" => "nomor telepon minimal 10 digit!",
                "user_phone.regex" => "nomor telepon boleh mengandung angka dan - !",
                "user_gender.required" => "gender tidak boleh kosong!",

                "user_password.required" => "password tidak boleh kosong!",
                "user_password.min" => "password minimal 8 karakter!",
                "password_confirmation.required" => "confirm password tidak boleh kosong!",
                "password_confirmation.same" => "confirm password harus sama dengan password!",
            ]
        );

        // dd($req->user_gender);
        $result = Users::create([
            "user_email" => $req->user_email,
            "user_password" => Hash::make($req->user_password),
            "user_name" => $req->user_name,
            "user_nama" => $req->user_nama,
            "user_role" => "Customer",
            "user_phone" => $req->user_phone,
            "user_gender" => $req->user_gender,
        ]);

        if ($result) {
            return redirect('/registerPage')->with('success', 'berhasil register!');
        } else {
            return back()->with('error', 'gagal register!');
        }
    }

    public function Category(Request $req)
    {
        $user = Auth::guard("web")->user();
        $category = Categories::where('category_name', $req->category)->first();
        $product = $category->Product;
        if (Auth::guard("web")->check()) {
            return view('User.homePageUser', [
                "curr" => $user,
                "product" => $product,
                "category" => $req->category,
            ]);
        } else {
            return view('Menu.homePage', [
                "product" => $product,
                "category" => $req->category,
            ]);
        }
    }

    public function homePageUser(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::all();
        return view('User.homePageUser', [
            "curr" => $user,
            "product" => $product,
            "category" => "Rekomendasi",
        ]);
    }

    public function search(Request $req)
    {
        $product = Product::where('product_name', 'like', '%' . $req->text . '%')->get();
        return view('Menu.homePage', [
            "product" => $product,
            "category" => $req->text,
        ]);
    }
}
