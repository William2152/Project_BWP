<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = "mysql";
    protected $table = "store";
    protected $primaryKey = 'store_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'store_name',
        'store_email',
        'store_img',
        'store_address',
        'store_revenue',
        'store_status',
        'user_id'
    ];

    public function Owner()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}
