<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "voucher";
    protected $primaryKey = 'voucher_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'voucher_nama',
        'voucher_img',
        'voucher_potongan',
        'voucher_tgl_berlaku',
    ];
}
