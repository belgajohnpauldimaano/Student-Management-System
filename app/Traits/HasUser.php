<?php
namespace App\Traits;

use App\Models\User;
use App\Models\FacultyInformation;
use App\Models\FinanceInformation;
use App\Models\AdmissionInformation;
use App\Models\RegistrarInformation;
use Illuminate\Support\Facades\Auth;

trait HasUser{

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }

    public function getFullPathNameAttribute() {
        return ucwords($this->last_name . '_' . $this->first_name. '_' . $this->middle_name);
    }

    public function getAdviserSignatureAttribute()
    {
        return ucwords($this->first_name. ' ' . $this->middle_name.' '.$this->last_name);
    }

    public function adviser()
    {
        return $this->hasOne(FacultyInformation::class, 'id', 'adviser_id');
    }

    public function employeeFaculty()
    {
        return $this->hasOne(FacultyInformation::class, 'id', 'employee_id');
    }

    public function employeeAdmission()
    {
        return $this->hasOne(AdmissionInformation::class, 'id', 'employee_id');
    }

    public function employeeFinance()
    {
        return $this->hasOne(FinanceInformation::class, 'id', 'employee_id');
    }

    public function employeeRegistrar()
    {
        return $this->hasOne(RegistrarInformation::class, 'id', 'employee_id');
    }

    public function isAdmin()
    {
        $isAdmin = Auth::user();
        return $isAdmin;
    }

    public function getLoginlinkAttribute(){
        $user = $this->hasOne(User::class, 'id', 'user_id')->first()->id;
        if($user){
            $url = config('autologin.prefix') . $user . config('autologin.suffix');
            return route('autologin', $url);  
        }else{
          return "#";
        }
    }

    public function getEmployeeUserTypeAttribute(){
        if($this->employee_type == 1){
            return $this->employeeFaculty->full_name;
        }

        if($this->employee_type == 2){
           return $this->employeeAdmission->full_name;
        }

        if($this->employee_type == 3){
           return $this->employeeFinance->full_name;
        }

        if($this->employee_type == 4){
           return $this->employeeRegistrar->full_name;
        }                      
    }

    public function getEmployeeTypeBadgeAttribute(){
        if($this->employee_type == 1){
            return '<span class="badge bg-blue">Faculty</span>';
        }

        if($this->employee_type == 2){
            return '<span class="badge bg-maroon">Admission</span>';
        }

        if($this->employee_type == 3){
            return '<span class="badge bg-indigo">Finance</span>';
        }

        if($this->employee_type == 4){
            return '<span class="badge bg-orange">Registrar</span>';
        }        
    }
}