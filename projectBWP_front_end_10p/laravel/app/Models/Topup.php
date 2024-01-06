<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topup extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table = "topup";
    protected $primaryKey = 'topup_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'topup_saldo',
        'topup_status',
    ];

    public function OwnerSaldo()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}
