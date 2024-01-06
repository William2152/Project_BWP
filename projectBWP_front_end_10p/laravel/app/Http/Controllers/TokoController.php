<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Store;
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

        $product = $toko->Products;
        return view("toko.tokoProductSaya", [
            "curr" => $user,
            "toko" => $toko,
            "product" => $product,
        ]);
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
        $store = $product->Toko;
        return view('Toko.EditProduct', [
            "product" => $product,
            "toko" => $store,
        ]);
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
}
