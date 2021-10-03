<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productbundel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'item_ids',
        'cost_price',
        'selling_price',
        'percentage_margin',
        'discount_price',
        'discount_start_date',
        'discount_end_date',
        'status',
        'short_description'
    ];

    public function images(){
        return $this->hasMany(Attachment::class,'attach_id','id')->where('type','=','productbundel_image')->orderBy('id','ASC');
    }

    public function track(){
        return $this->hasMany(ProductBundleTrack::class,'product_bundle_id','id');
    }
}
