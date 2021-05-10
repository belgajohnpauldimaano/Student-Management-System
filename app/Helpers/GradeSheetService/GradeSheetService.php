<?php

namespace App\Helpers\GradeSheetService;

use App\Models\Enrollment;
use App\Models\ClassDetail;


class GradeSheetService
{

    public function gradeSheet($StudentInformation_id, $SchoolYear_id)
    {
        return Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                ->where('student_information_id', $StudentInformation_id)
                ->where('class_subject_details.status', '!=', 0)
                ->where('enrollments.status', 1)
                ->where('class_details.status', 1)
                ->where('class_details.school_year_id', $SchoolYear_id)
                ->select(\DB::raw("
                    enrollments.id as enrollment_id,
                    enrollments.attendance,
                    enrollments.attendance_first,
                    enrollments.attendance_second,
                    enrollments.j_lacking_unit,
                    enrollments.s1_lacking_unit,
                    enrollments.s2_lacking_unit,
                    enrollments.eligible_transfer,
                    class_details.grade_level,
                    class_subject_details.id as class_subject_details_id,
                    class_subject_details.class_days,
                    class_subject_details.class_time_from,
                    class_subject_details.class_time_to,
                    class_subject_details.status as grade_status,
                    CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                    subject_details.id AS subject_id,
                    subject_details.subject_code,
                    subject_details.subject,
                    section_details.section,
                    class_details.school_year_id as school_year_id
                "))->orderBy('class_subject_details.class_subject_order', 'ASC');

    }

    public function signatory($SchoolYear_id, $StudentInformation)
    {
        return ClassDetail::with('student_enrollment')
                ->where('school_year_id', $SchoolYear_id)
                ->whereHas('student_enrollment', function ($query) use ($StudentInformation) {
                    $query->where('student_information_id', $StudentInformation->id);
                })
                ->whereStatus(1)
                ->first();
    }

    public function seniorFinalGrade($final_grade, $StudentEnrolledSubject, $grade_level, $grade_status, $semester)
    {
        $senior_final_ave = [];
        $general_avg_senior = 0;
        $sub_total1 = 0;
        $subj_count1 = 0;

        $senior_final_ave = $final_grade->map(function ($item, $key) use ($StudentEnrolledSubject, $grade_level, $grade_status, $semester) {
            $grade = $StudentEnrolledSubject->firstWhere('class_subject_details_id', $item->class_subject_details_id);
            $sum = 0;

            $first  = $grade['fir_g'] > 0 ? $grade['fir_g'] : 0;
            $second = $grade['sec_g'] > 0 ? $grade['sec_g'] : 0;
            $third  = $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
            $fourth = $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;
            
            $sum += $grade['fir_g'] > 0 ? $grade['fir_g'] : 0;
            $sum += $grade['sec_g'] > 0 ? $grade['sec_g'] : 0;
            $sum += $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
            $sum += $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;

            $divisor = 0;
            $divisor += $first  > 0 ? 1 : 0;
            $divisor += $second > 0 ? 1 : 0;
            $divisor += $third  > 0 ? 1 : 0;
            $divisor += $fourth > 0 ? 1 : 0;

            $final = 0;
            if ($divisor != 0) 
            {
                $final = $sum / $divisor;
            }

            return $data = [
                'final_g' => round($final)
            ];
        });

        for ($i=0; $i<count($senior_final_ave); $i++)
        {
            if ($senior_final_ave[$i]['final_g'] > 0)
            {
                $subj_count1++;
                $sub_total1 +=  $senior_final_ave[$i]['final_g'];
            }
        }
        if ($subj_count1 > 0) 
        {
            return $general_avg_senior = $sub_total1 / $subj_count1;
        }
    
    }
}