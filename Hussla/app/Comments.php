<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'user_id', 'customer', 'comment',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
