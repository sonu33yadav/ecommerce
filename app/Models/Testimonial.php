<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'type', 'desc'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function attach(){
        return $this->hasOne(Attachment::class,'attach_id','id')->where('type','testimonial');
    }
}
