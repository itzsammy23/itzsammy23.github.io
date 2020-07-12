<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'user_id', 'referral_id', 'referral_count',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
