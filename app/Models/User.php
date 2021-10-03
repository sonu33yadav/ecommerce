<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'contact_number',
        'login_type',
        'facebook_id',
        'birthday',
        'gender',
        'race_id',
        'address',
        'address2',
        'address3',
        'postcode',
        'state',
        'country_id',
        'department',
        'avatar',
        'designation',
        'role',
        'status',
        'manage_status',
        'language',
        'referral_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function referral_track(){
        return $this->hasMany(ReferralTrack::class,'customer_id','id');
    }

    public function race(){
        return $this->hasOne(Race::class,'id','race_id');
    }

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }
}
