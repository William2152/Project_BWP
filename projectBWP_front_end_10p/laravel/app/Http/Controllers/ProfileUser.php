<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Models\Store;
use App\Models\Topup;
use App\Models\Users;
use App\Models\Voucher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function Belumdikirim(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.belumdikirim", [
            "curr" => $user,
        ]);
    }

    public function sedangdikirim(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.terkirim", [
            "curr" => $user,
        ]);
    }

    public function selesai(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.selesai", [
            "curr" => $user,
        ]);
    }


    public function Voucher(Request $req)
    {

        $user = Auth::guard("web")->user();
        $voucher = $user->Vouchers;
        return view("User.voucherSaya", [
            "curr" => $user,
            "voucher" => $voucher,
        ]);
    }

    public function historypembelian(Request $req)
    {
        $user = Auth::guard("web")->user();
        $orders = $user->Orders;
        return view("User.historypembelian", [
            "curr" => $user,
            "orders" => $orders,
        ]);
    }

    public function historytopup(Request $req)
    {
        $user = Auth::guard("web")->user();
        $topup = $user->Topups;
        return view("User.historytopup", [
            "curr" => $user,
            "topups" => $topup,
        ]);
    }

    public function Saldo(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("User.saldoSaya", [
            "curr" => $user,
        ]);
    }

    public function ReqTopup(Request $req)
    {
        $req->validate(
            [
                "topup_saldo" => "required|numeric|min:1",
            ],
            [
                "topup_saldo.required" => "saldo tidak boleh kosong!",
                "topup_saldo.numeric" => "saldo harus dalam bentuk angka!",
                "topup_saldo.min" => "saldo harus lebih besar dari 0!",
            ]
        );

        $userID = Auth::guard("web")->user()->user_id;

        $result = Topup::create([
            "user_id" => $userID,
            "topup_saldo" => $req->topup_saldo,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil request topup!');
        } else {
            return back()->with('err', 'gagal request topup!');
        }
    }



    public function BuatToko(Request $req)
    {
        $user = Auth::guard("web")->user();
        return view("Toko.tambahToko", [
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

    public function TambahToko(Request $req)
    {
        $req->validate(
            [
                "namaToko" => "required",
                "alamat" => "required",
                "email" => "required|email",
            ],
            [
                "namaToko.required" => "nama tidak boleh kosong!",
                "alamat.required" => "alamat tidak boleh kosong!",
                "email.required" => "email tidak boleh kosong!",
                "email.email" => "email harus berbentuk email!",
            ]
        );
        $result = Store::create([
            "store_name" => $req->namaToko,
            "store_email" => $req->email,
            "store_address" => $req->alamat,
            "store_img" => null,
            "user_id" => Auth::guard("web")->user()->user_id,
            "store_revenue" => 0,
            "store_status" => 0
        ]);


        if ($result) {
            $userID = Auth::guard("web")->user()->user_id;
            $user = Users::find($userID);
            $user->update([
                "user_role" => "storeOwner",
            ]);
            return redirect("/tokosaya")->with('success', 'berhasil Tambah Toko!');
        } else {
            return back()->with('err', 'gagal Tambah Toko!');
        }
    }



    public function DeleteToko(Request $req)
    {
        $tokoID = Auth::guard("web")->user()->Toko->store_id;
        $deleteToko = Store::find($tokoID);
        $result = $deleteToko->delete();

        if ($result) {
            return back()->with('success', 'berhasil Delete Toko!');
        } else {
            return back()->with('err', 'gagal Delete Toko!');
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

    //cart n check out

    private function CartSess()
    {
        if (!Session::has('cart')) {
            $cart = [];
            Session::put('cart', $cart);
            return $cart;
        }

        $cart = Session::get('cart');
        return $cart;
    }

    private function searchIDProd($id)
    {
        $cart = $this->CartSess();

        foreach ($cart as $idx => $val) {
            if ($val['product']->product_id == $id) {
                return $idx;
            }
        }

        return -1;
    }


    public function ProsesCart(Request $req)
    {
        $req->validate(
            [
                "qty" => "required|numeric|min:1",
            ],
            [
                "qty.required" => "qty tidak boleh kosong!",
                "qty.numeric" => "qty harus angka!",
                "qty.min" => "qty harus lebih dari 0!",
            ]
        );

        $cart = $this->CartSess();
        $user = Auth::guard("web")->user();

        if ($req->btnAddCart != null) {
            //cari index session cart
            $idDelete = $this->searchIDProd($req->btnAddCart);

            //cari id
            $product = Product::find($req->btnAddCart);

            if ($idDelete != -1) {

                if ($cart[$idDelete]['qty'] + $req->qty <= $product->product_stock) {
                    $cart[$idDelete]['qty'] = $cart[$idDelete]['qty'] + $req->qty;
                    Session::put('cart', $cart);
                    return back()->with("success", "jumlah item berhasil di update!");
                } else {
                    return back()->with("err", "jumlah item yang dibeli lebih banyak daripada stock!");
                }
            }



            // $product = Product::find($req->btnAddCart);

            Session::push('cart', [
                "product" => $product,
                "qty" => $req->qty,
                "id_user" => $user->user_id,
            ]);

            return back()->with("success", "item berhasil di add ke cart!");
        } else {
        }
    }

    private function deleteItemCart($id_prod)
    {
        $cart = $this->CartSess();
        $idDelete = $this->searchIDProd($id_prod);

        if ($idDelete != -1) {
            unset($cart[$idDelete]);
            //reindexing
            $cart = array_values($cart);

            Session::put('cart', $cart);
        }
    }

    public function DeleteCart(Request $req)
    {
        $cart = $this->CartSess();
        $user = Auth::guard("web")->user();

        if ($req->btnDeleteCart != null) {

            // deleteCart
            $this->deleteItemCart($req->btnDeleteCart);

            return back();
        } else {
        }
    }



    private function UserCart($id)
    {
        $item = $this->CartSess();
        $privateCart = [];
        foreach ($item as $i) {
            if ($i['id_user'] == $id) {
                $privateCart[] = $i;
            }
        }
        return $privateCart;
    }

    //ini biar user cart private yang isinya barang di 1 toko aja
    private function UserCartByStoreID($s_id, $u_id)
    {
        $item = $this->CartSess();
        $privateCart = [];
        foreach ($item as $i) {
            if ($i['product']->store_id == $s_id && $i['id_user'] == $u_id) {
                $privateCart[] = $i;
            }
        }
        return $privateCart;
    }

    public function Cart(Request $req)
    {

        $user = Auth::guard("web")->user();
        $item = $this->UserCart($user->user_id);
        return view("User.userCart", [
            "curr" => $user,
            "items" => $item,
        ]);
    }

    public function CheckOut(Request $req)
    {

        $user = Auth::guard("web")->user();
        $item = $this->UserCart($user->user_id);
        $total = $this->hitungTotal();
        $voucher = $user->Vouchers;

        if (count($item) <= 0) {
            return back()->with("err", 'cart masih kosong!');
        }

        return view("User.userCheckout", [
            "curr" => $user,
            "items" => $item,
            "total" => $total,
            "voucher" => $voucher,
        ]);
    }

    //ini buat total semua barang dari masing" toko di cart
    public function hitungTotalStoreCart($s_id)
    {
        $user = Auth::guard("web")->user();
        $item = $this->UserCartByStoreID($s_id, $user->user_id);
        $total = 0;
        foreach ($item as $i) {
            $total += ($i['product']->product_price * $i['qty']);
        }
        return $total;
    }

    public function hitungGrandTotalStoreCart($id_v, $s_id)
    {
        $user = Auth::guard("web")->user();
        $item = $this->UserCartByStoreID($s_id, $user->user_id);
        $voucher = Voucher::find($id_v);

        $total = 0;
        $hasil = 0;

        foreach ($item as $i) {
            $total += ($i['product']->product_price * $i['qty']);
        }
        $diskon = 0;
        if ($voucher != null) {
            $diskon = (int) (($total * $voucher->voucher_potongan) / 100);
        }

        $hasil = $total - $diskon;


        return $hasil;
    }



    //ini buat total semua barang dari semua toko yang di halaman check out
    public function hitungTotal()
    {
        $user = Auth::guard("web")->user();
        $item = $this->UserCart($user->user_id);
        $total = 0;
        foreach ($item as $i) {
            $total += ($i['product']->product_price * $i['qty']);
        }
        return $total;
    }

    public function hitungGrandTotal($id_v)
    {
        $user = Auth::guard("web")->user();
        $item = $this->UserCart($user->user_id);
        $voucher = Voucher::find($id_v);

        $total = 0;
        $hasil = 0;

        foreach ($item as $i) {
            $total += ($i['product']->product_price * $i['qty']);
        }
        $diskon = 0;
        if ($voucher != null) {
            $diskon = (int) (($total * $voucher->voucher_potongan) / 100);
        }

        $hasil = $total - $diskon;


        return $hasil;
    }

    public function prosesCheckOut(Request $req)
    {
        $user = Auth::guard("web")->user();
        $item = $this->UserCart($user->user_id);
        $total = $this->hitungTotal();
        $grand_total = $this->hitungGrandTotal($req->order_disc);
        $voucher = Voucher::find($req->order_disc);

        // dd();

        //klo saldo ga cukup
        if ($user->user_money < $grand_total) {
            return back()->with('err', 'saldo tidak cukup');
        }



        //validation
        $req->validate(
            [
                "order_destination" => "required",
            ],
            [
                "order_destination.required" => "alamat pengiriman harus diisi!",
            ]
        );

        $id_toko_temp = [];
        $ada = false;
        foreach ($item as $c) {
            $ada = false;
            foreach ($id_toko_temp as $idt) {
                if ($idt == $c['product']->store_id) {
                    $ada = true;
                }
            }

            if ($ada == false) {
                $id_toko_temp[] = $c['product']->store_id;
            }
        }

        // dd($id_toko_temp);

        foreach ($id_toko_temp as $s_id) {
            # code...
            //insert orders dulu
            $perStoreTotal = $this->hitungTotalStoreCart($s_id);
            $perStoreGrandTotal = $this->hitungGrandTotalStoreCart($req->order_disc, $s_id);
            $result = Orders::create([
                "user_id" => $user->user_id,
                "voucher_id" => $req->order_disc,
                "order_total_no_disc" => $perStoreTotal,
                "order_total_amount" => $perStoreGrandTotal,
                "order_destination" => $req->order_destination,
                "store_id" => $s_id,
            ]);

            $itemPerStore = $this->UserCartByStoreID($s_id, $user->user_id);

            //insert ke masing order detail
            // $order_id = Orders::latest()->first()->order_id;
            $order_id  = $result->order_id;
            $order = Orders::find($order_id);
            $errMsg = "";
            try {
                //buat order detail
                foreach ($itemPerStore as $c) {
                    $result = $order->Products()->attach($c['product']->product_id, [
                        'order_product_quantity' => $c['qty']
                    ]);
                }
            } catch (QueryException $e) {
                // Tangani kesalahan
                $errMsg = $e->getMessage();
            }
        }

        //penyelesaian
        //klo success
        if ($errMsg == "") {

            //hapus cart
            foreach ($item as $c) {
                $this->deleteItemCart($c['product']->product_id);
            }
            //sek ada kemungkinan cart nyantol

            //deaktifkan voucher
            if ($voucher != null) {
                $voucher->Customers()->updateExistingPivot($user, [
                    'users_voucher_status' => 1,
                ]);
            }


            //kurangi saldo
            $saldoSisa = $user->user_money - $grand_total;
            $updateUser = Users::find($user->user_id);
            $updateUser->update([
                'user_money' => $saldoSisa,
            ]);

            return redirect("/profile/userCart")->with('success', 'berhasil checkout!');
        } else {
            return redirect("/profile/userCheckout")->with('err', $errMsg);
        }
    }
}
