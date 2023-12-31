<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KurirController extends Controller
{
    public function RegisterKurir(Request $req)
    {
        return view('Kurir.daftar');
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
            "user_role" => "Kurir",
            "user_phone" => $req->user_phone,
            "user_gender" => $req->user_gender,
        ]);

        if ($result) {
            return redirect('/loginPage')->with('success', 'berhasil register!');
        } else {
            return back()->with('error', 'gagal register!');
        }
    }

    public function kehalamanadminkurir(Request $req)
    {
        $order = Orders::where('order_status', 1)->get();
        $kurir = Users::where('user_role', "Kurir")->get();
        $user = Auth::guard("web")->user();
        return view('Kurir.admin', [
            "order" => $order,
            "kurir" => $kurir,
            "user" => $user,
        ]);
    }

    public function assignKurir(Request $req)
    {
        if ($req->kurir == null) {
            return back()->with('err', 'harus ada kurir yang di assign!');
        }

        if ($req->btnAssign != null) {
            $order = Orders::find($req->btnAssign);
            $result = $order->update([
                'kurir_id' => $req->kurir,
            ]);

            if ($result == true) {
                return back()->with('success', 'berhasil assign kurir!');
            } else {
                return back()->with('err', 'gagal assign kurir!');
            }
        }

        return back()->with('err', 'order id tidak ada!');
    }

    public function kehalamanhomekurir(Request $req)
    {
        $user = Auth::guard("web")->user();
        $order = Orders::where('kurir_id', $user->user_id)->get();
        return view('Kurir.home', [
            "order" => $order,
            "user" => $user,
        ]);
    }

    public function terima(Request $req)
    {
        if ($req->btnTerima != null) {
            $order = Orders::find($req->btnTerima);
            $result = $order->update([
                'order_status' => 2,
            ]);

            if ($result == true) {
                return back()->with('success', 'berhasil kirim pesanan!');
            } else {
                return back()->with('err', 'gagal kirim pesanan!');
            }
        }
    }
}
