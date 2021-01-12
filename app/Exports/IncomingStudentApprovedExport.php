<?php

namespace App\Exports;

use App\Models\SchoolYear;
use App\Models\StudentInformation;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncomingStudentApprovedExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        $IncomingStudentApproved = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
            ->join('users', 'users.id', '=', 'student_informations.user_id')                                   
            ->selectRaw('
                CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                student_informations.id as student_id,
                incoming_students.grade_level_id, 
                incoming_students.student_type, 
                incoming_students.approval,
                users.username, 
                users.status as user_status,
                student_informations.birthdate,
                student_informations.gender,
                student_informations.photo,
                student_informations.guardian,
                student_informations.mother_name,
                student_informations.father_name,
                student_informations.email,
                student_informations.contact_number,
                student_informations.c_address,
                student_informations.p_address,
                student_informations.guardian
            ')
            ->where('incoming_students.approval', 'Approved')
            ->where('incoming_students.school_year_id', $SchoolYear->id)            
            ->where('users.status', 1)            
            ->get(['transaction_month_paids.id']);

            $IncomingStudentApproved_array[] = array('Student Name', 'Student type', 'Student Level', 'LRN', 'Email address', 
                'Phone number', 'Birthdate' ,'Current Address', 'Permanent Address', 'Gender','Father name','Mother name', 'Guardian');
        
                
                foreach($IncomingStudentApproved as $data)
                {
                    $IncomingStudentApproved_array[] = array(
                        'Student Name'          => $data->student_name,
                        'Student type'          => $data->student_type == 1 ? 'Transferee' : 'Freshman',
                        'Student Level'         => $data->grade_level_id,
                        'LRN'                   => $data->username,
                        'Email address'         => $data->email,
                        'Phone number'          => $data->contact_number,
                        'Birthdate'             => date_format(date_create($data->birthdate), 'F d, Y'),
                        'Current Address'       => $data->c_address,
                        'Permanent Address'     => $data->p_address,
                        'Gender'                => $data->gender == 1 ? 'Male':'Female',
                        'Father name'           => $data->father_name,
                        'Mother name'           => $data->mother_name,
                        'Guardian'              => $data->guardian
                    );
                }
                
            return collect($IncomingStudentApproved_array);
    }
}