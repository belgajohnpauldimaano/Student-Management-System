<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUser;

class RegistrarInformation extends Model
{
    use HasUser;
    
    protected $table = 'registrar_informations';

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