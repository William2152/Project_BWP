<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
    ];

    public function sender()
    {
        return $this->belongsTo(Users::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Users::class, 'receiver_id');
    }
}
