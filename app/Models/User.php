<?php

namespace App\Models;

use App\Models\AdminInformation;
use App\Models\FacultyInformation;
use App\Models\FinanceInformation;
use App\Models\StudentInformation;
use App\Models\AdmissionInformation;
use App\Models\RegistrarInformation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $username = 'username';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public const USER_ROLES = [
        'root'      => [ 'id' => 0, 'display' => 'Moderator'],
        'admin'     => [ 'id' => 1, 'display' => 'Administrator'],
        'registrar' => [ 'id' => 3, 'display' => 'Registrar'],
        'faculty'   => [ 'id' => 4, 'display' => 'Faculty'],
        'student'   => [ 'id' => 5, 'display' => 'Student'],
        'finance'   => [ 'id' => 6, 'display' => 'Finance'],
        'admission'   => [ 'id' => 7, 'display' => 'Admission'],
    ];
    
    public function get_user_role ($roles) 
    {
        $rollls = [];
        if (is_array($roles)) {
            foreach ($roles as $r) 
            {
                if (array_key_exists($r, $this::USER_ROLES)) 
                {
                    if ($this->role == $this::USER_ROLES[$r]['id'])
                    {
                        return true;
                    }
                }
            }
        }
        else 
        {
            if (array_key_exists($roles, $this::USER_ROLES)) 
            {
                if ($this->role == $this::USER_ROLES[$roles]['id'])
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function get_user_data ()
    {
        $UserInformation = NULL;
        if ($this->role == 0 || $this->role == 1)
        {
            $UserInformation = AdminInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        else if ($this->role == 3)
        {
            $UserInformation = RegistrarInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        else if ($this->role == 4)
        {
            $UserInformation = FacultyInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        else if ($this->role == 5)
        {
            $UserInformation = StudentInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        else if ($this->role == 6)
        {
            $UserInformation = FinanceInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        else if ($this->role == 7)
        {
            $UserInformation = AdmissionInformation::where('user_id', $this->id)->where('status', 1)->first();
        }
        return $UserInformation;
    }

    public function get_user_role_display ()
    {
        $role_name = '';
        foreach ($this::USER_ROLES as $data)
        {
            if ($this->role == $data['id']) 
            {
                $role_name = $data['display'];
                break;
            }
        }
        return $role_name;
    }
}