<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
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
        'hussla_id','firstname', 'lastname', 'email', 'phone', 'businessname', 'businessinfo', 'businessphone',
        'businessaddress', 'specialize', 'businessmotto', 'state', 'area', 'loginmail',  'password',
        'usingFreeSubscription', 'usingPaidSubscription', 'isEligible',
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

            $user->referral()->create([
                'referral_id' => Str::random(15),
                'referral_count' => '0',
            ]);
        });
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function comments() {
        return $this->hasMany(Comments::class);
    }

    public function referral() {
        return $this->hasOne(Referral::class);
    }
}
