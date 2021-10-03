<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundleTrack extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','product_bundle_id','detail'];

    public function customer(){
        return $this->hasOne(User::class,'id','customer_id');
    }
}
