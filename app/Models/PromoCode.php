<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','desc','primary_type','secondary_type','amount','secondary_info','start_date','end_date','limit','enable_member_limit','earning_start_date','earning_end_date'
    ];

    public function primary(){
        return $this->hasOne(PromoPrimaryType::class,'id','primary_type');
    }

    public function secondary(){
        return $this->hasOne(PromoSecondaryType::class,'id','secondary_type');
    }

    public function track(){
        return $this->hasMany(PromoCodeTrack::class,'promo_code_id','id');
    }
}
