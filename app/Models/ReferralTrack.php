<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTrack extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','tracker_id','detail'];

    public function tracker(){
        return $this->hasOne(User::class,'id','tracker_id');
    }
}
