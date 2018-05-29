<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*
|About SJA Pages --------------------------------------------------------------------------
*/

Route::get('/school-profile', 'AboutController@school_profile')->name('school_profile');
Route::get('/vision-mission', 'AboutController@vision_mission')->name('vision_mission');
Route::get('/history', 'AboutController@history')->name('history');
Route::get('/hymn', 'AboutController@hymn')->name('hymn');
Route::get('/award-and-recognition', 'AboutController@award_recognition')->name('award_recognition');
Route::get('/administration-and-offices', 'AboutController@administration_offices')->name('administration_offices');

/*
|Academic Pages --------------------------------------------------------------------------
*/

Route::get('/junior-high', 'AcademicController@junior_high')->name('junior_high');
Route::get('/senior-high', 'AcademicController@senior_high')->name('senior_high');

/*
|Students Pages --------------------------------------------------------------------------
*/

Route::get('/students-organizations', 'StudentsController@students_organizations')->name('students_organizations');
Route::get('/students-services', 'StudentsController@students_services')->name('students_services');
Route::get('/publication', 'StudentsController@publication')->name('publication');
Route::get('/students-council', 'StudentsController@students_council')->name('students_council');
Route::get('/students-handbook', 'StudentsController@students_handbook')->name('students_handbook');


Route::group(['prefix' => 'registrar', 'middleware' => ['auth', 'userroles'], 'roles' => ['registrar']], function() {
    Route::get('dashboard', 'Registrar\RegistrarDashboardController@index')->name('registrar.dashboard');

    Route::group(['prefix' => 'class-details', 'middleware' => 'auth'], function() {
        Route::get('', 'Registrar\ClassListController@index')->name('registrar.class_details');
        Route::post('', 'Registrar\ClassListController@index')->name('registrar.class_details');
        Route::post('modal-data', 'Registrar\ClassListController@modal_data')->name('registrar.class_details.modal_data');
        Route::post('save-data', 'Registrar\ClassListController@save_data')->name('registrar.class_details.save_data');
        Route::post('deactivate-data', 'Registrar\ClassListController@deactivate_data')->name('registrar.class_details.deactivate_data');
        Route::post('fetch_section-by-grade-level', 'Registrar\ClassListController@fetch_section_by_grade_level')->name('registrar.class_details.fetch_section_by_grade_level');
        
    });

    Route::group(['prefix' => 'class-subjects/{class_id}', 'middleware' => 'auth'], function() {
        Route::get('', 'Registrar\ClassSubjectsController@index')->name('registrar.class_subjects');
        Route::post('', 'Registrar\ClassSubjectsController@index')->name('registrar.class_subjects');
        Route::post('modal-data', 'Registrar\ClassSubjectsController@modal_data')->name('registrar.class_subjects.modal_data');
        Route::post('save-data', 'Registrar\ClassSubjectsController@save_data')->name('registrar.class_subjects.save_data');
        Route::post('deactivate-data', 'Registrar\ClassSubjectsController@deactivate_data')->name('registrar.class_subjects.deactivate_data');
        
    });

    Route::group(['prefix' => 'student-enrollment/{id}', 'middleware' => ['auth']], function() {
        Route::get('', 'Registrar\StudentEnrollmentController@index')->name('registrar.student_enrollment');
        Route::post('', 'Registrar\StudentEnrollmentController@index')->name('registrar.student_enrollment');
        Route::post('modal-data', 'Registrar\StudentEnrollmentController@modal_data')->name('registrar.student_enrollment.modal_data');
        Route::post('save-data', 'Registrar\StudentEnrollmentController@save_data')->name('registrar.student_enrollment.save_data');
        Route::post('enroll-student', 'Registrar\StudentEnrollmentController@enroll_student')->name('registrar.student_enrollment.enroll_student');
        Route::post('enrolled-student', 'Registrar\StudentEnrollmentController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');
        Route::post('cancel-enroll-student', 'Registrar\StudentEnrollmentController@cancel_enroll_student')->name('registrar.student_enrollment.cancel_enroll_student');
    });

    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Registrar\UserProfileController@view_my_profile')->name('registrar.my_account.index');
        // Route::post('change-my-password', 'Registrar\UserProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Registrar\UserProfileController@update_profile')->name('registrar.my_account.update_profile');
        Route::post('fetch-profile', 'Registrar\UserProfileController@fetch_profile')->name('registrar.my_account.fetch_profile');
        Route::post('change-my-photo', 'Registrar\UserProfileController@change_my_photo')->name('registrar.my_account.change_my_photo');
        Route::post('change-my-password', 'Registrar\UserProfileController@change_my_password')->name('registrar.my_account.change_my_password');
    });
    
});


Route::group(['prefix' => 'faculty', 'middleware' => ['auth', 'userroles'], 'roles' => ['faculty']], function() {
    
    Route::get('dashboard', 'Faculty\FacultyDashboardController@index')->name('faculty.dashboard');
    
    Route::group(['prefix' => 'subject-class'], function() {
        Route::get('', 'Faculty\SubjectClassController@index')->name('faculty.subject_class');
        Route::post('list-class-subject-details', 'Faculty\SubjectClassController@list_class_subject_details')->name('faculty.subject_class.list_class_subject_details');
        Route::post('list-students-by-class', 'Faculty\SubjectClassController@list_students_by_class')->name('faculty.subject_class.list_students_by_class');
    });

    Route::group(['prefix' => 'class-schedules'], function() {
        Route::get('', 'Faculty\SubjectClassController@class_schedules')->name('faculty.class_schedules');
    });
    
    Route::group(['prefix' => 'student-grade-sheet'], function() {
        Route::get('', 'Faculty\GradeSheetController@index')->name('faculty.student_grade_sheet');
        Route::post('list-class-subject-details', 'Faculty\GradeSheetController@list_class_subject_details')->name('faculty.student_grade_sheet.list_class_subject_details');
        Route::post('list-students-by-class', 'Faculty\GradeSheetController@list_students_by_class')->name('faculty.student_grade_sheet.list_students_by_class');
    });

    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Faculty\UserProfileController@view_my_profile')->name('faculty.my_account.index');
        // Route::post('change-my-password', 'Faculty\UserProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Faculty\UserProfileController@update_profile')->name('faculty.my_account.update_profile');
        Route::post('fetch-profile', 'Faculty\UserProfileController@fetch_profile')->name('faculty.my_account.fetch_profile');
        Route::post('change-my-photo', 'Faculty\UserProfileController@change_my_photo')->name('faculty.my_account.change_my_photo');
        Route::post('change-my-password', 'Faculty\UserProfileController@change_my_password')->name('faculty.my_account.change_my_password');
    });
});


Route::group(['prefix' => 'admin/student-information', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar']], function() {
    Route::get('', 'Control_Panel\StudentController@index')->name('admin.student.information');
    Route::post('', 'Control_Panel\StudentController@index')->name('admin.student.information');
    Route::post('modal-data', 'Control_Panel\StudentController@modal_data')->name('admin.student.information.modal_data');
    Route::post('save-data', 'Control_Panel\StudentController@save_data')->name('admin.student.information.save_data');
    Route::post('deactivate-data', 'Control_Panel\StudentController@deactivate_data')->name('admin.student.information.deactivate_data');
});

Route::group(['prefix' => 'admin/faculty-information', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar']], function() {
    Route::get('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
    Route::post('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
    Route::post('modal-data', 'Control_Panel\FacultyController@modal_data')->name('admin.faculty_information.modal_data');
    Route::post('save-data', 'Control_Panel\FacultyController@save_data')->name('admin.faculty_information.save_data');
    Route::post('deactivate-data', 'Control_Panel\FacultyController@deactivate_data')->name('admin.faculty_information.deactivate_data');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root']], function() {
    Route::get('dashboard', 'Control_Panel\DashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'registrar-information'], function() {
        Route::get('', 'Control_Panel\RegistrarController@index')->name('admin.registrar_information');
        Route::post('', 'Control_Panel\RegistrarController@index')->name('admin.registrar_information');
        Route::post('modal-data', 'Control_Panel\RegistrarController@modal_data')->name('admin.registrar_information.modal_data');
        Route::post('save-data', 'Control_Panel\RegistrarController@save_data')->name('admin.registrar_information.save_data');
        Route::post('deactivate-data', 'Control_Panel\RegistrarController@deactivate_data')->name('admin.registrar_information.deactivate_data');
    });

    
    Route::group(['prefix' => 'maintenance'], function() {
        Route::group(['prefix' => 'school-year'], function() {
            Route::get('', 'Control_Panel\Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
            Route::post('', 'Control_Panel\Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
            Route::post('modal-data', 'Control_Panel\Maintenance\SchoolYearController@modal_data')->name('admin.maintenance.school_year.modal_data');
            Route::post('save-data', 'Control_Panel\Maintenance\SchoolYearController@save_data')->name('admin.maintenance.school_year.save_data');
            Route::post('deactivate-data', 'Control_Panel\Maintenance\SchoolYearController@deactivate_data')->name('admin.maintenance.school_year.deactivate_data');
            Route::post('toggle-current-sy', 'Control_Panel\Maintenance\SchoolYearController@toggle_current_sy')->name('admin.maintenance.school_year.toggle_current_sy');
        });

        Route::group(['prefix' => 'subjects'], function() {
            Route::get('', 'Control_Panel\Maintenance\SubjectController@index')->name('admin.maintenance.subjects');
            Route::post('', 'Control_Panel\Maintenance\SubjectController@index')->name('admin.maintenance.subjects');
            Route::post('modal-data', 'Control_Panel\Maintenance\SubjectController@modal_data')->name('admin.maintenance.subjects.modal_data');
            Route::post('save-data', 'Control_Panel\Maintenance\SubjectController@save_data')->name('admin.maintenance.subjects.save_data');
            Route::post('deactivate-data', 'Control_Panel\Maintenance\SubjectController@deactivate_data')->name('admin.maintenance.subjects.deactivate_data');
        });
        
        Route::group(['prefix' => 'class-rooms'], function() {
            Route::get('', 'Control_Panel\Maintenance\RoomController@index')->name('admin.maintenance.classrooms');
            Route::post('', 'Control_Panel\Maintenance\RoomController@index')->name('admin.maintenance.classrooms');
            Route::post('modal-data', 'Control_Panel\Maintenance\RoomController@modal_data')->name('admin.maintenance.classrooms.modal_data');
            Route::post('save-data', 'Control_Panel\Maintenance\RoomController@save_data')->name('admin.maintenance.classrooms.save_data');
            Route::post('deactivate-data', 'Control_Panel\Maintenance\RoomController@deactivate_data')->name('admin.maintenance.classrooms.deactivate_data');
        });

        Route::group(['prefix' => 'section-details'], function() {
            Route::get('', 'Control_Panel\Maintenance\SectionController@index')->name('admin.maintenance.section_details');
            Route::post('', 'Control_Panel\Maintenance\SectionController@index')->name('admin.maintenance.section_details');
            Route::post('modal-data', 'Control_Panel\Maintenance\SectionController@modal_data')->name('admin.maintenance.section_details.modal_data');
            Route::post('save-data', 'Control_Panel\Maintenance\SectionController@save_data')->name('admin.maintenance.section_details.save_data');
            Route::post('deactivate-data', 'Control_Panel\Maintenance\SectionController@deactivate_data')->name('admin.maintenance.section_details.deactivate_data');
        });
    });
    
    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Control_Panel\UserProfileController@view_my_profile')->name('my_account.index');
        // Route::post('change-my-password', 'Control_Panel\UserProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Control_Panel\UserProfileController@update_profile')->name('my_account.update_profile');
        Route::post('fetch-profile', 'Control_Panel\UserProfileController@fetch_profile')->name('my_account.fetch_profile');
        Route::post('change-my-photo', 'Control_Panel\UserProfileController@change_my_photo')->name('my_account.change_my_photo');
        Route::post('change-my-password', 'Control_Panel\UserProfileController@change_my_password')->name('my_account.change_my_password');
    });
    
    

});


Route::group(['prefix' => 'shared/class-schedule', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar']], function() {
    Route::get('', 'Control_Panel\ClassScheduleController@index')->name('shared.class_schedule.index');
    Route::post('', 'Control_Panel\ClassScheduleController@index')->name('shared.class_schedule.index');
    Route::post('get-faculty-class-schedule', 'Control_Panel\ClassScheduleController@get_faculty_class_schedule')->name('shared.class_schedule.get_faculty_class_schedule');
    
    // Route::post('change-my-password', 'Control_Panel\ClassScheduleController@change_my_password')->name('my_account.change_my_password');
    // Route::post('update-profile', 'Control_Panel\ClassScheduleController@update_profile')->name('my_account.update_profile');
    // Route::post('fetch-profile', 'Control_Panel\ClassScheduleController@fetch_profile')->name('my_account.fetch_profile');
    // Route::post('change-my-photo', 'Control_Panel\ClassScheduleController@change_my_photo')->name('my_account.change_my_photo');
    // Route::post('change-my-password', 'Control_Panel\ClassScheduleController@change_my_password')->name('my_account.change_my_password');
});



