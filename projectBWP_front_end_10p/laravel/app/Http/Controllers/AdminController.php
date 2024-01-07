<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Store;
use App\Models\Topup;
use App\Models\User;
use App\Models\Users;
use App\Models\Voucher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function kehalamanhistorypesanan(Request $req)
    {
        $order = Orders::all();
        $user = Users::all();
        return view('admin.historypesanan', [
            "order" => $order,
            "user" => $user,
        ]);
    }

    public function kehalamanhistorypesananfilter(Request $req)
    {
        if ($req->id == "-") {
            return redirect("/admin/historypesanan")->with('err', 'filter nama user harus diisi!');
        }

        $order = Orders::where('user_id', $req->id)->get();
        $user = Users::all();
        return view('admin.historypesanan', [
            "order" => $order,
            "user" => $user,
        ]);
    }

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

        // dd($req->voucher_expired);
        $req->validate(
            [
                "voucher_name" => "required",
                "voucher_expired" => "required|regex:/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/",
            ],
            [
                "voucher_name.required" => "nama voucher harus diisi!",
                "voucher_expired.required" => "tanggal voucher harus diisi!",
                "voucher_expired.regex" => "tanggal format harus sesuai format 00-00-0000 00:00!",
            ]
        );

        $img = $req->voucher_discount . "_persen.png";
        $tgl_exp = date("Y-m-d 23:59:59", strtotime($req->voucher_expired));
        // dd($tgl_exp);

        //insert voucher
        $result = Voucher::create([
            "voucher_nama" => $req->voucher_name,
            "voucher_img" => $img,
            "voucher_potongan" => $req->voucher_discount,
            "voucher_tgl_berlaku" => $tgl_exp,
        ]);

        //insert users_voucher
        $user = Users::all();
        $lastVoucher = Voucher::latest()->first()->voucher_id;
        $errMsg = "";
        try {
            foreach ($user as $u) {
                if ($u->user_role != "Admin") {
                    $result = $u->Vouchers()->attach($lastVoucher);
                }
            }
            return back()->with('success', 'berhasil seluruh insert voucher!');
        } catch (QueryException $e) {
            // Tangani kesalahan
            $errMsg = $e->getMessage();
            return back()->with('err', $errMsg);
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
