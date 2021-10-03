<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_end_date',
        'point_earn',
        'point_type',
        'second_level'
    ];
}
