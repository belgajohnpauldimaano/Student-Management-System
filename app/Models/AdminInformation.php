<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUser;

class AdminInformation extends Model
{
    use HasUser;

    protected $table = 'admin_informations';

    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name',
        'address',
        'email',
        'contact_number',
        'photo',
        'user_id',
        'current',
        'status'
    ];
}