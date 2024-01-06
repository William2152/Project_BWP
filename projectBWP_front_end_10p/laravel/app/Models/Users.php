<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table = "users";
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_email',
        'user_password',
        'user_name',
        'user_nama',
        'user_role',
        'user_phone',
        'user_gender',
        'user_img',
        'user_money',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    //setup buat auth
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function Toko()
    {
        return $this->hasOne(Store::class, 'user_id', 'user_id');
    }

    public function Topups()
    {
        return $this->hasMany(Topup::class, 'user_id', 'user_id');
    }

    public function Vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'users_voucher', 'user_id', 'voucher_id')
            ->withPivot('users_voucher_status');
    }
}
