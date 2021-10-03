<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'cost_price',
        'selling_price',
        'percentage_margin',
        'discount_price',
        'discount_start_date',
        'discount_end_date',
        'stock_quantity',
        'status',
        'short_description'
    ];

    public function images(){
        return $this->hasMany(Attachment::class,'attach_id','id')->where('type','=','product_image')->orderBy('id','ASC');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'product_id','id');
    }

    public function packages(){
        return $this->hasMany(ProductPackage::class,'product_id','id');
    }
}
