<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table = "product";
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'product_name',
        'product_img',
        'product_detail',
        'product_price',
        'product_stock',
        'product_avg_rating',
        'product_jumlah_avg_data',
        'category_id',
        'store_id',
    ];

    public function Category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'category_id');
    }

    public function Toko()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function Orders()
    {
        return $this->belongsToMany(Orders::class, 'order_product', 'product_id', 'order_id');
    }
}
