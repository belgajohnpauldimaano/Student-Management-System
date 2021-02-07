<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'path_name', 'type',
    ];
    
    public function documentable()
    {
        return $this->morphTo();
    }
}