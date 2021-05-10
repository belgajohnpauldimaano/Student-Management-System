<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Room;
use App\Models\Semester;
use Barryvdh\DomPDF\PDF;
use App\Models\DateRemark;
use App\Models\Enrollment;
use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\SectionDetail;
use App\Models\SubjectDetail;
use App\Traits\HasFacultyDetails;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\FacadesCrypt;
use Illuminate\Support\Facades\Crypt;
use App\Models\StudentEnrolledSubject;
use App\Helpers\GradeSheetService\GradeSheetService;

class AdvisoryClassController extends Controller
{
    use HasFacultyDetails;

    private $gradeSheetInfo;
    public function __construct(GradeSheetService $gradeSheetInfo){
        $this->gradeSheetInfo = $gradeSheetInfo;
    }

    public function index (Request $request) 
    {        
        $FacultyInformation = $this->faculty();
        
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();

        $ClassDetail = ClassDetail::with(['section','room','schoolYear','adviserData'])
            ->whereCurrent(1)
            ->whereStatus(1)
            ->whereSchoolYearId($SchoolYear->id)
            ->whereAdviserId($FacultyInformation->id)
            ->paginate(10);
        
        return view('control_panel_faculty.class_advisory.index', compact('ClassDetail', 'SchoolYear'));
    }
    
    public function view_class_list (Request $request) 
    {
        $FacultyInformation = $this->faculty();

        try {
            $class_id = Crypt::decrypt($request->c);
            
            $EnrollmentMale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
                ->whereRaw('enrollments.class_details_id = '. $class_id)
                ->whereRaw('student_informations.gender = 1')       
                ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.status,
                    student_informations.id,
                    users.username,
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
                ->orderBY('student_name', 'ASC')
                ->get();

            $EnrollmentFemale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
                ->whereRaw('enrollments.class_details_id = '. $class_id)
                ->whereRaw('student_informations.gender = 2')       
                ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.status,
                    student_informations.id,
                    users.username,
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
                ->orderBY('student_name', 'ASC')
                ->get();

            $ClassDetails = ClassDetail::with(['section', 'schoolYear'])
                ->where('class_details.id', $class_id)
                ->first();
                
            if($request->ajax()){            
                return view('control_panel_faculty.class_student.partials.data_list', 
                    compact('EnrollmentMale','EnrollmentFemale', 'ClassDetails', 'class_id'));
            }
            
            return view('control_panel_faculty.class_student.index', 
                compact('EnrollmentMale','EnrollmentFemale', 'ClassDetails', 'class_id'))->render();
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }
    
    public function manage_demographic_profile(Request $request)
    {
        $class_id = Crypt::decrypt($request->c);
        return view('control_panel_faculty.class_advisory.partials.modal_demographic_profile', compact('class_id'));
    }

    public function manage_attendance (Request $request) 
    {
        $FacultyInformation = $this->faculty();
        try {
            $class_id = Crypt::decrypt($request->c);
            $enrollment_id = Crypt::decrypt($request->enr);
            
            $Enrollment = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->whereRaw('enrollments.class_details_id = '. $class_id)
                ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
                ->whereRaw('enrollments.id = '. $enrollment_id)
                ->select(\DB::raw("
                    enrollments.id as e_id,
                    student_informations.id,
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    attendance
                "))
                ->first();

            $ClassDetails = ClassDetail::join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id', '=', 'class_details.school_year_id')
            ->where('class_details.id', $class_id)->first();
            
            $attendance_data = ['jan' => '30'];
            $attendance_data_str = json_encode($attendance_data);
            $attendance_data_parsed = json_decode($attendance_data_str);
            // return compact('Enrollment', 'ClassDetails', 'attendance_data_str', 'attendance_data_parsed');
            $student_attendance = [];
            $table_header = [
                ['key' => 'Jun',],
                ['key' => 'Jul',],
                ['key' => 'Aug',],
                ['key' => 'Sep',],
                ['key' => 'Oct',],
                ['key' => 'Nov',],
                ['key' => 'Dec',],
                ['key' => 'Jan',],
                ['key' => 'Feb',],
                ['key' => 'Mar',],
                ['key' => 'Apr',],
                ['key' => 'total',],
            ];
            $attendance_data = json_decode(json_encode([
                'days_of_school' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'days_present' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'days_absent' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'times_tardy' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ]
            ]));

            if ($Enrollment->attendance) {
                $attendance_data = json_decode($Enrollment->attendance);
            }

            $student_attendance = [
                'student_name'      => $Enrollment->student_name,
                'attendance_data'   => $attendance_data,
                'table_header'      => $table_header,
                'days_of_school_total' => array_sum($attendance_data->days_of_school),
                'days_present_total' => array_sum($attendance_data->days_present),
                'days_absent_total' => array_sum($attendance_data->days_absent),
                'times_tardy_total' => array_sum($attendance_data->times_tardy),
            ];
            $e_id = $Enrollment->e_id;
            return view('control_panel_faculty.class_advisory.partials.modal_manage_attendance', compact('student_attendance', 'class_id', 'e_id'))->render();
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }

    public function save_attendance (Request $request) 
    {
        $FacultyInformation = $this->faculty();
        try {
            
            $class_id = Crypt::decrypt($request->c);
            $enrollment_id = Crypt::decrypt($request->enr);

            $days_of_school = [
                // 18, 22, 20, 20, 18, 19, 16, 22, 19,21,5,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_of_school as $i => $d)
            {
                $days_of_school[$i] = $d;
            }
            
            $days_present = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_present as $i => $d)
            {
                $days_present[$i] = $d;
            }

            $days_absent = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_absent as $i => $d)
            {
                $days_absent[$i] = $d;
            }

            $times_tardy = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->times_tardy as $i => $d)
            {
                $times_tardy[$i] = $d;
            }

            $attendance_data = [
                'days_of_school' => $days_of_school,
                'days_present' => $days_present,
                'days_absent' => $days_absent,
                'times_tardy' => $times_tardy
            ];

            $Enrollment = Enrollment::whereRaw('enrollments.id = '. $enrollment_id)->first();
            $Enrollment->attendance = json_encode($attendance_data);
            $Enrollment->save();
            return json_encode([$request->all(), 'attendance_data' => json_encode($attendance_data), 'Enrollment' => $Enrollment]);
        }catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }
    
    public function modal_data (Request $request) 
    {
        $ClassDetail = NULL;
        $FacultyInformation = FacultyInformation::where('status', 1)->get();
        if ($request->id)
        {
            $ClassDetail = ClassDetail::where('id', $request->id)->first();
        }
        // $FacultyInformation = FacultyInformation::where('status', 1)->get();
        // $SubjectDetail = SubjectDetail::where('status', 1)->get();

        $SectionDetail = SectionDetail::where('status', 1)->orderBy('grade_level')->get();
        $SectionDetail_grade_levels = \DB::table('section_details')->select(\DB::raw('DISTINCT(grade_level) as grade_level'))->whereRaw('status = 1')->orderByRaw('grade_level ASC')->get();
        if ($ClassDetail) 
        {
            $SectionDetail = SectionDetail::where('status', 1)->where('grade_level', $ClassDetail->grade_level)->orderBy('grade_level')->get();
        }
        $GradeLevel = GradeLevel::where('status', 1)->get();
        $Room = Room::where('status', 1)->get();
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->get();
        return view('control_panel_faculty.class_advisory.partials.modal_data', compact('ClassDetail', 'SectionDetail', 'Room', 'SchoolYear', 'SectionDetail_grade_levels', 'GradeLevel', 'FacultyInformation'))->render();
    }

    public function modal_manage_subjects (Request $request) 
    {
        $ClassDetail = NULL;
        if ($request->id)
        {
            $ClassDetail = ClassDetail::where('id', $request->id)->first();
        }
        // return json_encode($ClassDetail);
        $FacultyInformation = FacultyInformation::where('status', 1)->get();
        $SubjectDetail = SubjectDetail::where('status', 1)->get();
        $SectionDetail = SectionDetail::where('status', 1)->get();
        $Room = Room::where('status', 1)->get();
        $SchoolYear = SchoolYear::where('status', 1)->get();
        return view('control_panel_faculty.class_advisory.partials.modal_manage_subjects', compact('ClassDetail', 'FacultyInformation', 'SubjectDetail', 'SectionDetail', 'Room', 'SchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'section'       => 'required',
            'room'          => 'required',
            'school_year'   => 'required',
            'grade_level'   => 'required',
            'adviser'       => 'required',
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $sectionDetail = SectionDetail::where('id', $request->section)->first();

        if ($request->id)
        {
            $ClassDetail = ClassDetail::where('id', $request->id)->first();
            $ClassDetail->section_id	 = $request->section;
            $ClassDetail->room_id	 = $request->room;
            $ClassDetail->school_year_id = $request->school_year;
            $ClassDetail->grade_level = $request->grade_level;
            $ClassDetail->adviser_id = $request->adviser;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $ClassDetail = new ClassDetail();
        $ClassDetail->section_id	 = $request->section;
        $ClassDetail->room_id	 = $request->room;
        $ClassDetail->school_year_id = $request->school_year;
        $ClassDetail->grade_level = $request->grade_level;
        $ClassDetail->adviser_id = $request->adviser;
        $ClassDetail->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $ClassDetail = ClassDetail::where('id', $request->id)->first();

        if ($ClassDetail)
        {
            $ClassDetail->current = 0;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
    public function delete_data (Request $request)
    {
        $ClassDetail = ClassDetail::where('id', $request->id)->first();

        if ($ClassDetail)
        {
            $ClassDetail->status = 0;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function fetch_section_by_grade_level (Request $request)
    {
        $SectionDetail = SectionDetail::where('grade_level', $request->grade_level)->where('status', 1)->get();
        if ($request->type == 'json') 
        {
            return response()->json(compact('SectionDetail'));
        }

        $section_details_elem = '<option value="">Select section</option>';
        foreach($SectionDetail as $data) 
        {
            $section_details_elem .= '<option value="'. $data->id .'">' . $data->section . '</option>';
        }
        return $section_details_elem;
    }

    public function print_student_class_grades (Request $request)
    {
        if (!$request->id || !$request->cid) 
        {
            return "Invalid request";
        }

        $StudentInformation = StudentInformation::with(['user'])->whereId(Crypt::decrypt($request->id))->first();
        $SchoolYear = SchoolYear::whereCurrent(1)->whereStatus(1)->first();
        $DateRemarks = DateRemark::whereSchoolYearId($SchoolYear->id)->first();
        $level = $request->level;
        
        if ($StudentInformation) 
        {
            $ClassDetail = ClassDetail::with(['section','room','schoolYear','adviserData'])
                ->whereCurrent(1)
                ->whereStatus(1)
                ->whereSchoolYearId($SchoolYear->id)
                ->whereId(Crypt::decrypt($request->cid))
                ->first();
            // return json_encode($ClassDetail);

            $Signatory = $this->gradeSheetInfo->signatory($SchoolYear->id, $StudentInformation);
            
            
            $semester = Semester::where('current', 1)->first()->id;
            
            // return json_encode($semester);
            // $Enrollment = Enrollment::with(['classDetail', 'room', 'faculty', 'section', 'subject'])
            //     ->whereStatus(1)
            //     ->whereHas('classDetail', function($query) use ($SchoolYear) {
            //         $query->where('school_year_id', $SchoolYear->id);
            //     })
            //     ->get();

            $query = $this->gradeSheetInfo->gradeSheet($StudentInformation->id, $SchoolYear->id);

                if($ClassDetail->grade_level > 10){
                    $query->where('class_subject_details.sem', $semester);
                }
               
            $Enrollment = $query->get();

            $final_grade = $this->gradeSheetInfo->gradeSheet($StudentInformation->id, $SchoolYear->id)->get();

            // return json_encode($Enrollment);

            if($Enrollment->isEmpty()){
                $title = 'Sorry this is not available';
                $message = 'This semester is not ready for this function or please contact the administrator. Thank you!';
                return view('errors._page_not_available', compact('title','message'));
            }
            
            $GradeSheetData = [];
            $grade_level = 1;
            $sub_total = 0;
            $general_avg = 0;
            $subj_count = 0;
            $grade_status = $Enrollment[0]->grade_status;
            
            $Totalsubject = ClassSubjectDetail::with(['subject','classDetail','faculty'])
                ->where('class_details_id', $ClassDetail->id)
                ->where('status', 1)
                ->orderBY('class_subject_order','DESC')
                ->WhereHas('classDetail', function($query) use ($SchoolYear) {
                    $query->where('school_year_id', $SchoolYear->id);
                })
                ->count();

            $senior_final_ave = [];
            $general_avg_senior = 0;
            $sub_total1 = 0;
            $subj_count1 = 0;
            
            // return json_encode(['c' => count($Enrollment),'Enrollment' => $Enrollment,'StudentInformation' => $StudentInformation, ]);
            if ($StudentInformation && count($Enrollment)>0)
            {
                $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)->get();

                $grade_level = $Enrollment[0]->grade_level;
                
                $general_avg_senior = $this->gradeSheetInfo->seniorFinalGrade($final_grade, $StudentEnrolledSubject, $grade_level, $grade_status, $semester);
                // return json_encode($general_avg_senior);

                $GradeSheetData = $Enrollment->map(function ($item, $key) use ($StudentEnrolledSubject, $grade_level, $grade_status, $semester) {
                    // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id);
                    // return json_encode($class_subject_details);
                    $grade = $StudentEnrolledSubject->firstWhere('class_subject_details_id', $item->class_subject_details_id);
                    
                    $sum = 0;
                    if($grade_level < 11)
                    {
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
                    }
                    

                    if($grade_level > 10){

                        if($semester == 1){
                            $first = $grade['fir_g'] > 0 ? $grade['fir_g'] : 0;
                            $second = $grade['sec_g'] > 0 ? $grade['sec_g'] : 0;

                            $sum += $grade['fir_g'] > 0 ? $grade['fir_g'] : 0;
                            $sum += $grade['sec_g'] > 0 ? $grade['sec_g'] : 0;
                        }

                        if($semester == 2){
                            $first = $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
                            $second = $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;

                            $sum += $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
                            $sum += $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;
                        }
                        
                        $divisor = 0;
                        $divisor += $first > 0 ? 1 : 0;
                        $divisor += $second > 0 ? 1 : 0;
                    }

                    $final = 0;
                    if ($divisor != 0) 
                    {
                        $final = $sum / $divisor;
                    }
                    

                    if($grade_level > 10){
                        if($semester == 1){
                            $lacking_unit = $item->s1_lacking_unit;
                        }else{
                            $lacking_unit = $item->s2_lacking_unit;
                        }
                    }

                    if($grade_level < 11){
                        $lacking_unit = $item->j_lacking_unit;
                    }

                    if($grade_level > 10){

                        if($semester == 1){
                            $data = [
                                'enrollment_id'     =>  $item->enrollment_id,
                                'grade_level'       =>  $item->grade_level,
                                'class_days'        =>  $item->class_days,
                                'class_time_from'   =>  $item->class_time_from,
                                'class_time_to'     =>  $item->class_time_to,
                                'faculty_name'      =>  $item->faculty_name,
                                'subject_id'        =>  $item->subject_id,
                                'subject_code'      =>  $item->subject_code,
                                'subject'           =>  $item->subject,
                                'room_code'         =>  $item->room_code,
                                'section'           =>  $item->section,
                                'grade_id'          =>  $grade['id'] ,
                                'fir_g'             =>  $grade['fir_g'],
                                'sec_g'             =>  $grade['sec_g'],
                                'final_g'           =>  round($final),
                                'grade_status'      =>  $grade_status,
                                'divisor'           =>  $divisor,
                                'eligible_transfer' =>  $item->eligible_transfer,
                                'lacking_unit'      =>  $lacking_unit,
                            ];
                        }

                        if($semester == 2){
                            $data = [
                                'enrollment_id'     =>  $item->enrollment_id,
                                'grade_level'       =>  $item->grade_level,
                                'class_days'        =>  $item->class_days,
                                'class_time_from'   =>  $item->class_time_from,
                                'class_time_to'     =>  $item->class_time_to,
                                'faculty_name'      =>  $item->faculty_name,
                                'subject_id'        =>  $item->subject_id,
                                'subject_code'      =>  $item->subject_code,
                                'subject'           =>  $item->subject,
                                'room_code'         =>  $item->room_code,
                                'section'           =>  $item->section,
                                'grade_id'          =>  $grade['id'] ,
                                'thi_g'             =>  $grade['thi_g'],
                                'fou_g'             =>  $grade['fou_g'],
                                'final_g'           =>  round($final),
                                'grade_status'      =>  $grade_status,
                                'divisor'           =>  $divisor,
                                'eligible_transfer' =>  $item->eligible_transfer,
                                'lacking_unit'      =>  $lacking_unit,
                            ];
                        }
                    }

                    if($grade_level < 11)
                    {
                        $data = [
                            'enrollment_id'     =>  $item->enrollment_id,
                            'grade_level'       =>  $item->grade_level,
                            'class_days'        =>  $item->class_days,
                            'class_time_from'   =>  $item->class_time_from,
                            'class_time_to'     =>  $item->class_time_to,
                            'faculty_name'      =>  $item->faculty_name,
                            'subject_id'        =>  $item->subject_id,
                            'subject_code'      =>  $item->subject_code,
                            'subject'           =>  $item->subject,
                            'room_code'         =>  $item->room_code,
                            'section'           =>  $item->section,
                            'grade_id'          =>  $grade['id'],
                            'fir_g'             =>  $grade['fir_g'],
                            'sec_g'             =>  $grade['sec_g'],
                            'thi_g'             =>  $grade['thi_g'],
                            'fou_g'             =>  $grade['fou_g'],
                            'final_g'           =>  round($final),
                            'grade_status'      =>  $grade_status,
                            'divisor'           =>  $divisor,
                            'eligible_transfer' =>  $item->eligible_transfer,
                            'lacking_unit'      =>  $lacking_unit,
                            
                        ];
                    }
                    return $data;
                });
                // return json_encode($GradeSheetData);
                for ($i=0; $i<count($GradeSheetData); $i++)
                {
                    if ($GradeSheetData[$i]['final_g'] > 0)
                    {
                        $subj_count++;
                        $sub_total +=  $GradeSheetData[$i]['final_g'];
                    }
                }
                if ($subj_count > 0) 
                {
                    $general_avg = $sub_total / $subj_count;
                }
            }
            $GradeSheetData = json_decode(json_encode($GradeSheetData));           
        
                if(10 == $SchoolYear->id)
                {    
                    if($Enrollment[0]->grade_level > 10)
                    {     
                        if($semester == 1)
                        {
                            $table_header = [
                                ['key' => 'Aug',],
                                ['key' => 'Sep',],
                                ['key' => 'Oct',],
                                ['key' => 'Nov',],
                                ['key' => 'Dec',],
                                ['key' => 'total']
                            ];       
                        }  
                        
                        if($semester == 2)
                        {
                            $table_header = [
                                ['key' => 'Jan',],
                                ['key' => 'Feb',],
                                ['key' => 'Mar',],
                                ['key' => 'Apr',],
                                ['key' => 'May',],
                                ['key' => 'total']
                            ];       
                        }
                    }
                                
                    if($Enrollment[0]->grade_level < 11)
                    {          
                        $table_header = [
                            ['key' => 'Aug',],
                            ['key' => 'Sep',],
                            ['key' => 'Oct',],
                            ['key' => 'Nov',],
                            ['key' => 'Dec',],
                            ['key' => 'Jan',],
                            ['key' => 'Feb',],
                            ['key' => 'Mar',],
                            ['key' => 'Apr',],
                            ['key' => 'May',],
                            ['key' => 'total'],
                        ];
                    }
                }
                else
                {   
                    if($SchoolYear->school_year == '2019-2020'){                        
                        if($Enrollment[0]->grade_level > 10)
                        {
                            if($semester == 1)
                            {
                                $table_header = [
                                    ['key' => 'Jun',],
                                    ['key' => 'Jul',],
                                    ['key' => 'Aug',],
                                    ['key' => 'Sep',],
                                    ['key' => 'Oct',],
                                    ['key' => 'total'],
                                ];
                            }
                            
                            if($semester == 2)
                            {    
                                $table_header = [
                                    ['key' => 'Nov',],
                                    ['key' => 'Dec',],
                                    ['key' => 'Jan',],
                                    ['key' => 'Feb',],
                                    ['key' => 'Mar*',],
                                    ['key' => 'Apr*',],
                                    ['key' => 'total'],
                                ];
                            }      
                        }
                        
                        if($Enrollment[0]->grade_level < 11)
                        {
                            $table_header = [
                                ['key' => 'Jun',],
                                ['key' => 'Jul',],
                                ['key' => 'Aug',],
                                ['key' => 'Sep',],
                                ['key' => 'Oct',],
                                ['key' => 'Nov',],
                                ['key' => 'Dec',],
                                ['key' => 'Jan',],
                                ['key' => 'Feb',],
                                ['key' => 'Mar*',],
                                ['key' => 'Apr*',],
                                ['key' => 'total',],
                            ];
                        }
                    }else{

                        if($Enrollment[0]->grade_level > 10)
                        {
                            if($semester == 1)
                            {
                                $table_header = [
                                    ['key' => 'Jun',],
                                    ['key' => 'Jul',],
                                    ['key' => 'Aug',],
                                    ['key' => 'Sep',],
                                    ['key' => 'Oct',],
                                    ['key' => 'total'],
                                ];
                            }

                            if($semester == 2)
                            {
                                $table_header = [
                                    ['key' => 'Nov',],
                                    ['key' => 'Dec',],
                                    ['key' => 'Jan',],
                                    ['key' => 'Feb',],
                                    ['key' => 'Mar',],
                                    ['key' => 'Apr',],
                                    ['key' => 'total'],
                                ];
                            }
                        }  
                        
                        if($Enrollment[0]->grade_level < 11)
                        {
                            $table_header = [
                                ['key' => 'Jun',],
                                ['key' => 'Jul',],
                                ['key' => 'Aug',],
                                ['key' => 'Sep',],
                                ['key' => 'Oct',],
                                ['key' => 'Nov',],
                                ['key' => 'Dec',],
                                ['key' => 'Jan',],
                                ['key' => 'Feb',],
                                ['key' => 'Mar',],
                                ['key' => 'Apr',],
                                ['key' => 'total',],
                            ];
                        }
                    }  
                }
                        
                if($Enrollment[0]->grade_level > 10)
                {
                    if($semester == 1)
                    {
                        $attendance_data = json_decode($Enrollment[0]->attendance_first);
                    }

                    if($semester == 2)
                    {
                        $attendance_data = json_decode($Enrollment[0]->attendance_second);
                    }

                }
                
                if($Enrollment[0]->grade_level < 11)
                {
                    $attendance_data = json_decode($Enrollment[0]->attendance);
                }

                $student_attendance = [
                    'attendance_data'       => $attendance_data,
                    'table_header'          => $table_header,
                    'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                    'days_present_total'    => array_sum($attendance_data->days_present),
                    'days_absent_total'     => array_sum($attendance_data->days_absent),
                    'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                ];
                        
                    
            return view('control_panel_student.grade_sheet.partials.print', compact('GradeSheetData', 'grade_level', 'StudentInformation',
                'ClassDetail', 'general_avg', 'student_attendance', 'table_header','Signatory','DateRemarks','Enrollment','general_avg_senior'));
                
            $pdf = \PDF::loadView('control_panel_student.grade_sheet.partials.print', compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail'
                 , 'general_avg', 'student_attendance', 'table_header','Signatory','DateRemarks','Enrollment','general_avg_senior'));
                return $pdf->stream();
            
            return view('control_panel_student.grade_sheet.index', compact('GradeSheetData'));
            return json_encode(['GradeSheetData' => $GradeSheetData,]);
        }
        else {
            return "Invalid request";
        }
    }
} 