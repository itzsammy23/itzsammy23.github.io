<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'businessname', 'businessinfo', 'businessphone',
        'businessaddress', 'specialize', 'businessmotto', 'state', 'area', 'loginmail',  'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'image' => 'profile/upKNMblSSlvhaMQIPMDripKIlqcabcDwfPfEsMv2.jpeg',
                'voteCount' => '0',
                'ratedIndex' => '0',
                'rating' => '0',
                'views' => '0',
            ]);
        });
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function comments() {
        return $this->hasMany(Comments::class);
    }
}
