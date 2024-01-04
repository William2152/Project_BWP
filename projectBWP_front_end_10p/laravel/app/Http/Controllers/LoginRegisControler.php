<?php

namespace App\Http\Controllers;

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
        ]);
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
                return view('user.adminPage', ["curr" => $user]);
            } else if ($user->user_role == "Customer") {
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

    public function CategoryElectronic(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 1)->get();
        return view('category.electric', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryClothes(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 2)->get();
        return view('category.clothes', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryJewelry(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 3)->get();
        return view('category.jewelry', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryMedicine(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 4)->get();
        return view('category.medicine', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryMusic(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 20)->get();
        return view('category.music', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryShoes(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 5)->get();
        return view('category.shoes', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryBag(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 6)->get();
        return view('category.bag', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryBook(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 7)->get();
        return view('category.book', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryCook(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 8)->get();
        return view('category.cook', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryToys(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 9)->get();
        return view('category.cook', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategorySport(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 10)->get();
        return view('category.sport', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryPediatric(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 11)->get();
        return view('category.pediatrics', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryHeadphone(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 12)->get();
        return view('category.headphone', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryPhone(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 13)->get();
        return view('category.phone', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryArt(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 14)->get();
        return view('category.art', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryFood(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 15)->get();
        return view('category.food', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryKeyboard(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 16)->get();
        return view('category.keyboard', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryPets(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 17)->get();
        return view('category.pets', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryGarden(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 18)->get();
        return view('category.garden', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function CategoryFurniture(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::where('category_id', 19)->get();
        return view('category.furniture', [
            "curr" => $user,
            "product" => $product,
        ]);
    }

    public function homePageUser(Request $req)
    {
        $user = Auth::guard("web")->user();
        $product = Product::all();
        return view('User.homePageUser', [
            "curr" => $user,
            "product" => $product,
        ]);
    }
}
