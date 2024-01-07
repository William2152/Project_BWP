<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table = "orders";
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'voucher_id',
        'store_id',
        'kurir_id',
        'order_total_no_disc',
        'order_total_amount',
        'order_status',
        'order_destination',
        'created_at',
    ];

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('product_id', 'order_product_id', 'order_product_quantity', 'order_product_review', 'order_product_rating');
    }

    public function Kurir()
    {
        return $this->belongsTo(Users::class, 'kurir_id', 'user_id');
    }

    public function Voucher()
    {
        return $this->hasOne(Voucher::class, 'voucher_id', 'voucher_id');
    }

    public function Toko()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function Owned()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}
