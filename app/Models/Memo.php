<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'sender_id',
        'status',
        'sent_at'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
