<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendPair extends Model
{
    use HasFactory;

    protected $fillable = ['answer_ids','product_ids'];
}
