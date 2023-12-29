<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

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
}
