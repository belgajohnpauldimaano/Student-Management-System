<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    public function schoolYear()
    {
        return $this->hasOne(User::class, 'school_year_id', 'id');
    }

    public function getApplyTypeAttribute()
    {
        // $apply_type = [
        //     '',
        //     'Admin Only', 
        //     'Admin | Registration for Enrollment', 
        //     'Admin | Registration for Enrollment | Payment' 
        // ];
        // return $apply_type[$this->apply_to];
        $apply_type = json_decode($this->apply_to, true);

        $apply = '';
        foreach($apply_type as $key => $item)
        {
            $apply = '<div class="icheck-primary d-inline">
                <input type="checkbox" name="apply_to_'. $item['apply_name'] .'" onclick="this.checked=!this.checked;" id="checkboxPrimary4" '. $item['is_apply'] == true ? 'checked' : '' .' >
                <label for="checkboxPrimary4" class="text-capitalize">
                    '.$item['apply_name'].'
                </label>
            </div>';
        }

        return $apply;

        // @foreach (json_decode($data['apply_to'], true) as $key => $item)
                            
        //                 @endforeach
    }
}