<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileUser extends Controller
{
    public function Profile(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.profileDetail", [
            "curr" => $user,
        ]);
    }

    public function ProfilePass(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.profilePassword", [
            "curr" => $user,
        ]);
    }

    public function Pesanan(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.pesananSaya", [
            "curr" => $user,
        ]);
    }

    public function Voucher(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.voucherSaya", [
            "curr" => $user,
        ]);
    }

    public function Saldo(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.saldoSaya", [
            "curr" => $user,
        ]);
    }

    public function ubahProfile(Request $req)
    {
        $req->validate(
            [
                "user_img" => "required",
                "user_name" => "required",
                "user_nama" => "required",
                "user_email" => "required|email",
                "user_phone" => "required|numeric|digits:10",
                "user_gender" => "required",

            ],
            [
                "user_img.required" => "image tidak boleh kosong!",
                "user_name.required" => "username tidak boleh kosong!",
                "user_nama.required" => "nama tidak boleh kosong!",
                "user_email.required" => "email tidak boleh kosong!",
                "user_email.email" => "email harus berbentuk email!",
                "user_phone.required" => "nomor telepon tidak boleh kosong!",
                "user_phone.numeric" => "nomor telepon harus dalam bentuk angka!",
                "user_phone.digits" => "nomor telepon minimal 10 digit!",
                "user_gender.required" => "gender tidak boleh kosong!",

            ]
        );
        $userID = Auth::guard("web")->user()->user_id;
        $updateUser = Users::find($userID);
        $result = $updateUser->update($req->all());

        if ($result) {
            return back()->with('success', 'berhasil update data!');
        } else {
            return back()->with('err', 'gagal update data!');
        }
    }

    public function ubahProfilePass(Request $req)
    {
        //ga bole kosong dan hrs minim 8 digit
        $req->validate(
            [
                "oldpw" => "required|min:8",
                "newpw" => "required|min:8",
                "confirmnewpw" => "required|same:newpw",

            ],
            [
                "oldpw.required" => "password lama tidak boleh kosong!",
                "oldpw.min" => "password lama minimal 8 karakter!",
                "newpw.required" => "password baru tidak boleh kosong!",
                "newpw.min" => "password baru minimal 8 karakter!",
                "confirmnewpw.required" => "confirm password tidak boleh kosong!",
                "confirmnewpw.same" => "confirm password harus sama dengan password!",
            ]
        );

        $user = Auth::guard("web")->user();
        $oldPass = $user->user_password;

        if (!Hash::check($req->oldpw, $oldPass)) {
            return back()->with('err', 'password lama salah!');
        }


        $updateUser = Users::find($user->user_id);
        $result = $updateUser->update(
            [
                "user_password" => Hash::make($req->newpw),
            ]
        );

        if ($result) {
            return back()->with('success', 'berhasil update password!');
        } else {
            return back()->with('err', 'gagal update password!');
        }
    }
}
