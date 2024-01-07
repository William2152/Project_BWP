<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "order_product";
    protected $primaryKey = 'order_product_id';
    public $incrementing = true;
    public $timestamps = true;
}
