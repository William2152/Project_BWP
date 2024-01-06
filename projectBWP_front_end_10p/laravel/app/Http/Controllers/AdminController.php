<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Topup;
use App\Models\User;
use App\Models\Users;
use App\Models\Voucher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function kehalamanacc(Request $req)
    {
        $topup = Topup::where('topup_status', 0)->get();
        return view('admin.topup', [
            "topup" => $topup,
        ]);
    }

    public function kehalamanstore(Request $req)
    {
        $store = Store::where('store_status', 0)->get();
        return view('admin.store', [
            "store" => $store,
        ]);
    }

    public function kehalamanhistory(Request $req)
    {
        $topup = Topup::all();
        return view('admin.history', [
            "topup" => $topup,
        ]);
    }

    public function VoucherPage(Request $req)
    {
        // $topup = Topup::where('topup_status', 0)->get();
        return view('admin.voucher', [
            // "topup" => $topup,
        ]);
    }



    public function buatstoreberhasil(Request $req)
    {
        $store_id = $req->terima;
        $berhasil = Store::find($store_id);
        $res = $berhasil->update([
            "store_status" => 1,
        ]);

        if ($res) {
            return back()->with('success', 'berhasil acc store!');
        } else {
            return back()->with('err', 'gagal acc store!');
        }
    }

    public function buatstoregagal(Request $req)
    {
        $store_id = $req->tolak;
        $gagal = Store::find($store_id);
        $res = $gagal->update([
            "store_status" => 2,
        ]);

        if ($res) {
            return back()->with('success', 'berhasil acc store!');
        } else {
            return back()->with('err', 'gagal acc store!');
        }
    }

    public function topupberhasil(Request $req)
    {
        $topup_id = $req->berhasil;
        $topup = Topup::find($topup_id);
        $res = $topup->update([
            "topup_status" => 1,
        ]);

        $user_id = $topup->OwnerSaldo->user_id;
        // dd($user_id);
        $user = Users::find($user_id);
        $saldo = $user->user_money + $topup->topup_saldo;
        // dd($saldo);
        $result = $user->update([
            "user_money" =>  $saldo,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil acc topup!');
        } else {
            return back()->with('err', 'gagal acc topup!');
        }
    }

    public function addvoucher(Request $req)
    {
        $convertedDatetime = date("Y-m-d H:i:00", strtotime($req->voucher_expired));

        $req->validate(
            [
                "voucher_name" => "required",
                "voucher_expired" => "required",
            ],
            [
                "voucher_name.required" => "nama voucher harus diisi!",
                "voucher_expired.required" => "tanggal voucher harus diisi!",
                // "voucher_expired.date_format" => "tanggal format harus sesuai format 00-00-0000 00:00:00!",
            ]
        );

        $img = $req->voucher_discount . "_persen.png";
        $tgl_exp = date("Y-m-d 00:00:00", strtotime($req->voucher_expired));
        dd($tgl_exp);

        $result = Voucher::create([
            "voucher_nama" => $req->voucher_name,
            "voucher_img" => $img,
            "voucher_potongan" => $req->voucher_discount,
            "voucher_tgl_berlaku" => $tgl_exp,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil insert voucher!');
        } else {
            return back()->with('err', 'gagal insert voucher!');
        }
    }

    public function userDelete(Request $req)
    {
        $user = $req->delete;
        // dd($user);
        $users = Users::find($user);

        if ($users) {
            $users->delete();
            return back()->with('success', 'berhasil delete user!');
        } else {
            return back()->with('err', 'gagal delete user!');
        }
    }

    public function topupgagal(Request $req)
    {
        $topup_id = $req->gagal;
        $topup = Topup::where("topup_id", $topup_id);
        $result = $topup->update([
            "topup_status" => 2,
        ]);
        if ($result) {
            return back()->with('success', 'berhasil menolak topup!');
        } else {
            return back()->with('err', 'gagal menolak topup!');
        }
    }
}
