<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'recommmend_answer_id'];
}
