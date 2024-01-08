<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $columns;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'order_id' => $item->order_id,
                'user_nama' => optional($item->Owned)->user_nama, // Ambil nama user menggunakan relasi
                'voucher_name' => optional($item->Voucher)->voucher_nama, // Ambil nama voucher menggunakan relasi
                'store_name' => optional($item->Toko)->store_name, // Ambil nama toko menggunakan relasi
                'kurir_name' => optional($item->Kurir)->user_nama, // Ambil nama kurir menggunakan relasi
                'order_total_no_disc' => $item->order_total_no_disc,
                'order_total_amount' => $item->order_total_amount,
                'order_status' => $this->setStatus($item->order_status),
                'order_destination' => $item->order_destination,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'deleted_at' => $item->deleted_at,
            ];
        });
    }

    public function setStatus($status)
    {
        if ($status == 0) {
            return "Belum diproses";
        } else if ($status == 1) {
            return "Menunggu Kurir";
        } else if ($status == 2) {
            return "Sedang Dikirim";
        } else if ($status == 3) {
            return "Selesai";
        }
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
