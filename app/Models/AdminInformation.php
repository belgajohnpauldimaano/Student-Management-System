<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class AdminInformation extends Model
{
    use HasUser, HasImage;

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