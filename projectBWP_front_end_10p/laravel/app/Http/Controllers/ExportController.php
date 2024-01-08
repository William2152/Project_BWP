<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Exports\OrderExport;
use App\Models\Orders;
use App\Models\Users;
use Illuminate\Auth\GenericUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $req)
    {
        if ($req->btnExport == "user") {
            //table user
            $dataUsers = Users::all();
            $colUser = [
                'user_id',
                'user_email',
                'user_password',
                'user_name',
                'user_nama',
                'user_money',
                'user_role',
                'user_img',
                'user_gender',
                'user_phone',
                'created_at',
                'updated_at',
                'deleted_at',
            ];
            $exportData = new GenericExport($dataUsers, $colUser);
        } else if ($req->btnExport == "order") {
            // table order

            $dataOrder = Orders::select('orders.*', 'user_table.user_nama as user_nama', 'voucher.voucher_nama as voucher_name', 'store.store_name as store_name', 'kurir.user_nama as kurir_nama')
                ->leftJoin('users as user_table', 'orders.user_id', '=', 'user_table.user_id')
                ->leftJoin('voucher', 'orders.voucher_id', '=', 'voucher.voucher_id')
                ->leftJoin('store', 'orders.store_id', '=', 'store.store_id')
                ->leftJoin('users as kurir', 'orders.kurir_id', '=', 'kurir.user_id')
                ->get();
            $colOrder = [
                'order_id',
                'user_id',
                'voucher_id',
                'store_id',
                'kurir_id',
                'order_total_no_disc',
                'order_total_amount',
                'order_status',
                'order_destination',
                'created_at',
                'updated_at',
                'deleted_at',
            ];
            $exportData = new OrderExport($dataOrder, $colOrder);
        }




        //table order product

        //table top up

        //table toko
        // try {
        //     return Excel::download(function ($excel) use ($exportUser, $exportOrders) {
        //         $excel->sheet('Users', $exportUser);
        //         // $excel->sheet('Orders', $exportOrders);
        //     }, 'dataDBKaStore.xlsx');
        // } catch (\Exception $e) {
        //     // Tampilkan pesan kesalahan langsung sebagai respons JSON
        //     return response()->json(['error' => 'Failed to export Excel: ' . $e->getMessage()], 500);
        // }

        return Excel::download($exportData, $req->btnExport . '.xlsx');
    }
}
