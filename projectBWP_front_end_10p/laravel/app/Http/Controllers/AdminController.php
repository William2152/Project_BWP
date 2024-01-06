<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Topup;
use App\Models\Users;
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
