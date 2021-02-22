<?php

namespace App\Models;

use App\Traits\HasInstruction;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasInstruction;

    protected $fillable=[
        'question_type',
        'instructions',
        'order_number',
        'instructionable_type',
        'instructionable_id'
    ];

    
}