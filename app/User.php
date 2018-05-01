<?php

namespace App;

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
        'root'      => 0,
        'admin'     => 1,
        'registrar' => 3,
        'faculty'   => 4,
        'student'   => 5
    ];
    public function get_user_role ($roles) 
    {
        $rollls = [];
        if (is_array($roles)) {
            foreach ($roles as $r) 
            {
                if (array_key_exists($r, $this::USER_ROLES)) 
                {
                    if ($this->role == $this::USER_ROLES[$r])
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
                if ($this->role == $this::USER_ROLES[$roles])
                {
                    return true;
                }
            }
        }
        return false;
    }
}
