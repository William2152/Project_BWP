<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

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

    public function Customers()
    {
        return $this->belongsToMany(Users::class, 'users_voucher', 'voucher_id', 'user_id');
    }
}
