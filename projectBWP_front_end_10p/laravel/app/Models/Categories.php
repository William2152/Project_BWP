<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table = "category";
    protected $primaryKey = 'category_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'category_name',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
