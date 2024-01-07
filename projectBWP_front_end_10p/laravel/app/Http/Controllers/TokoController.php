<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Store;
use App\Models\Messages;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function TokoSaya(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko = $user->Toko;


        if ($toko == null) {
            return view("toko.gakpunyatoko", [
                "curr" => $user,
            ]);
        }

        if ($toko->store_status === 1) {
            $product = $toko->Products;
            return view("toko.tokoProductSaya", [
                "curr" => $user,
                "toko" => $toko,
                "product" => $product,
            ]);
        } else {
            return view("Toko.belumacc", [
                "curr" => $user,
            ]);
        }
    }

    public function AddProductPage(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko = $user->Toko;
        $category = Categories::all();

        return view('menu.tambahProduct', [
            "curr" => $user,
            "toko" => $toko,
            "category" => $category,
        ]);
    }

    public function EditProductPage(Request $req)
    {
        $product = Product::find($req->id);
        $category = Categories::all();
        $store = $product->Toko;
        return view('Toko.EditProduct', [
            "product" => $product,
            "toko" => $store,
            "category" => $category,
        ]);
    }

    public function getMessages(Request $request)
    {
        $request->validate([
            'senderId' => 'required|integer',
            'receiverId' => 'required|integer',
        ]);

        $senderId = $request->senderId;
        $receiverId = $request->receiverId;

        $messages = Messages::select('messages.*', 'sender.user_nama as sender_name', 'receiver.user_nama as receiver_name')
            ->join('users as sender', 'messages.sender_id', '=', 'sender.user_id')
            ->join('users as receiver', 'messages.receiver_id', '=', 'receiver.user_id')
            ->where(function ($query) use ($senderId, $receiverId) {
                $query->where('messages.sender_id', $senderId)
                    ->where('messages.receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('messages.sender_id', $receiverId)
                    ->where('messages.receiver_id', $senderId);
            })
            ->orderBy('messages.created_at', 'ASC')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'senderId' => 'required|integer',
            'receiverId' => 'required|integer',
            'content' => 'required|string',
        ]);

        $senderId = $request->senderId;
        $receiverId = $request->receiverId;
        $content = $request->input("content");

        $message = new Messages();
        $message->sender_id = $senderId;
        $message->receiver_id = $receiverId;
        $message->content = $content;

        if ($message->save()) {
            return redirect()->back()->with('success', 'Message sent successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to send message');
        }
    }

    public function edittoko(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko = $user->Toko;
        return view("Toko.editToko", [
            "curr" => $user,
            "toko" => $toko,
        ]);
    }

    public function UpdateToko(Request $req)
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
        $tokoID = Auth::guard("web")->user()->Toko->store_id;
        $updateToko = Store::find($tokoID);
        $result = $updateToko->update([
            "store_name" => $req->namaToko,
            "store_email" => $req->email,
            "store_address" => $req->alamat,
            "store_img" => $req->urlLogoToko,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil update Toko!');
        } else {
            return back()->with('err', 'gagal update Toko!');
        }
    }

    public function AddProduct(Request $req)
    {

        $req->validate(
            [
                "product_img" => "required",
                "product_name" => "required",
                "product_price" => "required|numeric|min:1",
                "product_stock" => "required|numeric",
                "product_detail" => "required",
            ],
            [
                "product_img.required" => "url gambar produk tidak boleh kosong!",
                "product_name.required" => "nama produk tidak boleh kosong!",
                "product_price.required" => "harga tidak boleh kosong!",
                "product_price.numeric" => "harga harus angka!",
                "product_price.min" => "harga harus lebih besar dari 0!",
                "product_stock.required" => "stok produk tidak boleh kosong!",
                "product_stock.numeric" => "stok harus angka!",
                "product_detail.required" => "deskripsi product tidak boleh kosong!",
            ]
        );

        // dd($req->all());

        $result = Product::create([
            "product_img" => $req->product_img,
            "product_name" => $req->product_name,
            "product_price" => $req->product_price,
            "product_stock" => $req->product_stock,
            "product_detail" => $req->product_detail,
            "category_id" => $req->category_id,
            "store_id" => Auth::guard("web")->user()->Toko->store_id,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil add Product!');
        } else {
            return back()->with('err', 'gagal add Product!');
        }
    }

    public function EditProduct(Request $req)
    {

        $req->validate(
            [
                "product_img" => "required",
                "product_name" => "required",
                "product_price" => "required|numeric|min:1",
                "product_stock" => "required|numeric",
                "product_detail" => "required",
            ],
            [
                "product_img.required" => "url gambar produk tidak boleh kosong!",
                "product_name.required" => "nama produk tidak boleh kosong!",
                "product_price.required" => "harga tidak boleh kosong!",
                "product_price.numeric" => "harga harus angka!",
                "product_price.min" => "harga harus lebih besar dari 0!",
                "product_stock.required" => "stok produk tidak boleh kosong!",
                "product_stock.numeric" => "stok harus angka!",
                "product_detail.required" => "deskripsi product tidak boleh kosong!",
            ]
        );

        $productID = $req->id;
        $updateProduct = Product::find($productID);
        $result = $updateProduct->update([
            "product_img" => $req->product_img,
            "product_name" => $req->product_name,
            "product_price" => $req->product_price,
            "product_stock" => $req->product_stock,
            "category_id" => $req->category_id,
            "product_detail" => $req->product_detail,
        ]);

        if ($result) {
            return back()->with('success', 'berhasil add Product!');
        } else {
            return back()->with('err', 'gagal add Product!');
        }
    }

    public function itemPage(Request $req)
    {
        $product = Product::find($req->id);
        $store = $product->Toko;
        return view('menu.itemPage', [
            "product" => $product,
            "toko" => $store,
        ]);
    }

    public function ProdukToko(Request $req)
    {
        $storeid = $req->toko_id;
        $toko = Store::where('store_id', $storeid)->first();
        $product = Product::where('store_id', $storeid)->get();
        return view('MenuUser.Produk', [
            "product" => $product,
            "toko" => $toko,
        ]);
    }

    public function TentangToko(Request $req)
    {
        $storeid = $req->toko_id;
        $toko = Store::where('store_id', $storeid)->first();
        return view('MenuUser.TentangToko', [
            "toko" => $toko,
        ]);
    }

    public function kehalamanacc(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko_id = $user->Toko->store_id;
        // dd($toko_id);
        $toko = $user->Toko;
        $order = Orders::where('store_id', $toko_id)->get();
        return view('Toko.accpesanan', [
            "order" => $order,
            "user" => $user,
            "toko" => $toko,
        ]);
    }

    public function kehalamandetail(Request $req)
    {
        $user = Auth::guard("web")->user();
        $order = Orders::find($req->order_id);
        $toko = $user->Toko;
        // // dd($toko_id);
        $product = $order->Products;
        // $order = Orders::where('store_id', $toko_id)->get();
        return view('Toko.detail', [
            "user" => $user,
            "product" => $product,
            "toko" => $toko,
        ]);
    }

    public function kehalamanhistorypesanan(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko_id = $user->Toko->store_id;
        // dd($toko_id);
        $toko = $user->Toko;
        $order = Orders::where('store_id', $toko_id)->where('order_status', '>', 1)->where('order_status', '<', 4)->get();
        return view('Toko.historypesanan', [
            "order" => $order,
            "user" => $user,
            "toko" => $toko,
        ]);
    }

    public function kehalamantarik(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko_id = $user->Toko->store_id;
        // dd($toko_id);
        $toko = $user->Toko;
        return view('Toko.tarikrevenue', [
            "user" => $user,
            "toko" => $toko,
        ]);
    }

    public function tarik(Request $req)
    {
        $result = false;
        $user = Auth::guard("web")->user();
        $users = Users::find($user->user_id);
        $toko_id = $user->Toko->store_id;
        $toko = $user->Toko;
        if ($req->revenue <= $toko->store_revenue) {
            $saldo = $req->revenue + $user->user_money;
            $saldotoko = $toko->store_revenue - $req->revenue;
            $result = $users->update([
                "user_money" => $saldo,
            ]);
            $result = $toko->update([
                "store_revenue" => $saldotoko,
            ]);
        }
        if ($result) {
            return back()->with('success', 'berhasil transfer saldo!');
        } else {
            return back()->with('err', 'gagal transfer saldo!');
        }
    }

    public function terima(Request $req)
    {
        if ($req->btnTerima != null) {
            $order = Orders::find($req->btnTerima);
            //update order status
            $result = $order->update([
                'order_status' => 1,
            ]);

            //kurangi stock
            $products = $order->Products;
            // $pr = $order->Products();
            $toko = $order->Toko;
            foreach ($products as $p) {
                $hasil = $p->update([
                    "product_stock" => $p->product_stock - $p->pivot->order_product_quantity,
                ]);
            }

            //tambah store revenue
            $result = $toko->update([
                'store_revenue' => $toko->store_revenue + $order->order_total_amount,
            ]);

            if ($result == true) {
                return back()->with('success', 'berhasil acc pesanan!');
            } else {
                return back()->with('err', 'gagal acc pesanan!');
            }
        }
    }
    public function ChatTokoAsOwner(Request $req)
    {
        $user = Auth::guard("web")->user();
        $toko = $user->Toko;
        $senderId = $user->user_id;

        $senderIds = Messages::select('sender_id')
            ->where('receiver_id', $senderId)
            ->whereNotNull('content')
            ->groupBy('sender_id')
            ->pluck('sender_id');

        $senderNames = Users::select('user_id', 'user_nama as receiver_name')
            ->whereIn('user_id', $senderIds)
            ->get();

        return view("Toko.chatToko", compact('senderId', 'senderNames', 'user', 'toko'));
    }

    public function ChatTokoAsUser(Request $req)
    {
        $user = Auth::guard("web")->user();
        if($user != null) {
            $senderId = $user->user_id;
            $receiverId = $req->toko_id;
            $receiverUser = Store::where('store_id', $receiverId)->first();
            $receiver = Users::where('user_id', $receiverUser->user_id)->first();
            if ($receiver) {
                $receiverName = $receiver->user_nama;
            } else {
                $receiverName = 'Unknown Receiver';
            }
            return view('MenuUser.chatToko', compact('senderId', 'receiverId', 'receiverName'));
        } else {
            return redirect('/loginPage');
        }
    }
}
