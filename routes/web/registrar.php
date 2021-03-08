<?php

Route::group(['prefix' => 'registrar', 'middleware' => ['auth', 'userroles'], 'roles' => ['registrar']], function() {
    Route::group(['namespace' => 'Registrar'], function(){
        Route::get('dashboard', 'RegistrarDashboardController@index')->name('registrar.dashboard');

        Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
            Route::get('', 'UserProfileController@view_my_profile')->name('registrar.my_account.index');
            // Route::post('change-my-password', 'UserProfileController@change_my_password')->name('my_account.change_my_password');
            Route::post('update-profile', 'UserProfileController@update_profile')->name('registrar.my_account.update_profile');
            Route::post('fetch-profile', 'UserProfileController@fetch_profile')->name('registrar.my_account.fetch_profile');
            Route::post('change-my-photo', 'UserProfileController@change_my_photo')->name('registrar.my_account.change_my_photo');
            Route::post('change-my-password', 'UserProfileController@change_my_password')->name('registrar.my_account.change_my_password');
        });
        
        Route::group(['prefix' => 'student-grade-sheet'], function() {
            Route::get('', 'GradeSheetController@index')->name('registrar.student_grade_sheet');
            Route::post('list-class-subject-details', 'GradeSheetController@list_class_subject_details')->name('registrar.student_grade_sheet.list_class_subject_details');
            Route::post('list-students-by-class', 'GradeSheetController@list_students_by_class')->name('registrar.student_grade_sheet.list_students_by_class');
        });
    });
    
});

Route::group(['namespace' => 'Registrar'], function(){
    Route::group(['prefix' => 'registrar/class-details', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'registrar']], function() {
        Route::get('', 'ClassListController@index')->name('registrar.class_details');
        Route::post('', 'ClassListController@index')->name('registrar.class_details');
        Route::post('modal-data', 'ClassListController@modal_data')->name('registrar.class_details.modal_data');
        Route::post('save-data', 'ClassListController@save_data')->name('registrar.class_details.save_data');
        Route::post('deactivate-data', 'ClassListController@deactivate_data')->name('registrar.class_details.deactivate_data');
        Route::post('fetch_section-by-grade-level', 'ClassListController@fetch_section_by_grade_level')->name('registrar.class_details.fetch_section_by_grade_level');
    });

    Route::group(['prefix' => 'registrar/student-list', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'registrar']], function() {
        // Route::get('', 'StudentAdmissionController@index')->name('registrar.student_admission');
        // Route::post('', 'StudentAdmissionController@index')->name('registrar.student_admission');
        Route::get('grade7', 'StudentAdmissionController@grade7')->name('registrar.student_admission.grade7');
        Route::post('grade7', 'StudentAdmissionController@grade7')->name('registrar.student_admission.grade7');
        Route::get('grade8', 'StudentAdmissionController@grade8')->name('registrar.student_admission.grade8');
        Route::post('grade8', 'StudentAdmissionController@grade8')->name('registrar.student_admission.grade8');
        Route::get('grade9', 'StudentAdmissionController@grade9')->name('registrar.student_admission.grade9');
        Route::post('grade9', 'StudentAdmissionController@grade9')->name('registrar.student_admission.grade9');
        Route::get('grade10', 'StudentAdmissionController@grade10')->name('registrar.student_admission.grade10');
        Route::post('grade10', 'StudentAdmissionController@grade10')->name('registrar.student_admission.grade10');
        Route::get('grade11', 'StudentAdmissionController@grade11')->name('registrar.student_admission.grade11');
        Route::post('grade11', 'StudentAdmissionController@grade11')->name('registrar.student_admission.grade11');
        Route::get('grade12', 'StudentAdmissionController@grade12')->name('registrar.student_admission.grade12');
        Route::post('grade12', 'StudentAdmissionController@grade12')->name('registrar.student_admission.grade12');
        Route::post('enroll-student', 'StudentAdmissionController@enroll_student')->name('registrar.student_admission.enroll_student');
    });

    // Route::group(['prefix' => 'incoming-student', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'registrar']], function() {
    //     Route::get('', 'IncomingStudentController@index')->name('admission.incoming_student');
    //     Route::post('', 'IncomingStudentController@index')->name('admission.incoming_student');

    //     Route::get('Approved', 'IncomingStudentController@Approved')->name('admission.Approved');
    //     Route::post('Approved', 'IncomingStudentController@Approved')->name('admission.Approved');

    //     Route::get('Disapproved', 'IncomingStudentController@Disapproved')->name('admission.Disapproved');
    //     Route::post('Disapproved', 'IncomingStudentController@Disapproved')->name('admission.Disapproved');

    //     Route::post('modal', 'IncomingStudentController@modal_data')->name('admission.incoming_student.modal');
    //     Route::post('approve', 'IncomingStudentController@approve')->name('admission.incoming_student.approve');
    //     Route::post('disapprove', 'IncomingStudentController@disapprove')->name('admission.incoming_student.disapprove');
    //     // Route::post('enroll-student', 'IncomingStudentController@enroll_student')->name('registrar.incoming_student.enroll_student');

    //     // Route::get('/export_excel/excel', 'IncomingStudentController@excel')->name('export_excel.excel.admission');
    // });


    Route::group(['prefix' => 'registrar/class-subjects/{class_id}', 'middleware' => 'auth'], function() {
        Route::get('', 'ClassSubjectsController@index')->name('registrar.class_subjects');
        Route::post('', 'ClassSubjectsController@index')->name('registrar.class_subjects');
        Route::post('modal-data', 'ClassSubjectsController@modal_data')->name('registrar.class_subjects.modal_data');
        Route::post('modal-data-faculty', 'ClassSubjectsController@modalDataFaculty')->name('registrar.class_subjects.modal_data_faculty');
        Route::post('save-data', 'ClassSubjectsController@save_data')->name('registrar.class_subjects.save_data');
        Route::post('save-faculty-data', 'ClassSubjectsController@saveDataFaculty')->name('registrar.class_subjects.save_faculty_data');
        Route::post('delete-data', 'ClassSubjectsController@deleteDataFaculty')->name('registrar.faculty_id.delete_data');
        Route::post('deactivate-data', 'ClassSubjectsController@deactivate_data')->name('registrar.class_subjects.deactivate_data');
    });

    Route::group(['prefix' => 'registrar/student-enrollment/{id}', 'middleware' => ['auth'], 'roles' => ['admin', 'root', 'registrar']], function() {
        Route::get('', 'StudentEnrollmentController@index')->name('registrar.student_enrollment');
        Route::post('', 'StudentEnrollmentController@index')->name('registrar.student_enrollment');
        Route::post('modal-data', 'StudentEnrollmentController@modal_data')->name('registrar.student_enrollment.modal_data');
        Route::post('save-data', 'StudentEnrollmentController@save_data')->name('registrar.student_enrollment.save_data');
        Route::post('enroll-student', 'StudentEnrollmentController@enroll_student')->name('registrar.student_enrollment.enroll_student');
        Route::post('re-enroll-student', 'StudentEnrollmentController@re_enroll_student')->name('registrar.student_enrollment.re_enroll_student');
        Route::post('re-enroll-student-all', 'StudentEnrollmentController@re_enroll_student_all')->name('registrar.student_enrollment.re_enroll_student_all');
        Route::post('enrolled-student', 'StudentEnrollmentController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');
        Route::get('enrolled-student', 'StudentEnrollmentController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');
        Route::post('cancel-enroll-student', 'StudentEnrollmentController@cancel_enroll_student')->name('registrar.student_enrollment.cancel_enroll_student');
        
        Route::post('drop-student', 'StudentEnrollmentController@drop')
            ->name('registrar.student_enrollment.drop');

        Route::get('print-enrolled-students', 'StudentEnrollmentController@print_enrolled_students')
            ->name('registrar.student_enrollment.print_enrolled_students');
    });

    Route::group(['prefix' => 'registrar/student-enrolled-list/{id}', 'middleware' => ['auth'], 'roles' => ['admin', 'root', 'registrar']], function() {
        Route::get('', 'StudentEnrolledListController@index')->name('registrar.student_enrolled_list');
        Route::post('', 'StudentEnrolledListController@index')->name('registrar.student_enrolled_list');
        Route::post('drop-student', 'StudentEnrolledListController@drop')->name('student_enrolled.drop');
    });
});


    Route::group(['prefix' => 'admin/student-information', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar', 'admission']], function() {
        Route::get('', 'Control_Panel\StudentController@index')->name('admin.student.information');
        Route::post('', 'Control_Panel\StudentController@index')->name('admin.student.information');
        Route::post('modal-data', 'Control_Panel\StudentController@modal_data')->name('admin.student.information.modal_data');
        Route::get('modal-data', 'Control_Panel\StudentController@modal_data')->name('admin.student.information.modal_data');
        Route::post('save-data', 'Control_Panel\StudentController@save_data')->name('admin.student.information.save_data');
        Route::post('deactivate-data', 'Control_Panel\StudentController@deactivate_data')->name('admin.student.information.deactivate_data');
        Route::post('activate-data', 'Control_Panel\StudentController@activate_data')->name('admin.student.information.activate_data');
        Route::post('print-student-grade-modal', 'Control_Panel\StudentController@print_student_grade_modal')->name('admin.student.information.print_student_grade_modal');
        Route::post('list-semester', 'Control_Panel\StudentController@getSemester')->name('admission.get_semester');
        Route::get('print-student-grades', 'Control_Panel\StudentController@print_student_grades')->name('admin.student.information.print_student_grades');
        Route::post('change-student-photo', 'Control_Panel\StudentController@change_my_photo')->name('admin.student.change_my_photo');
    });


    Route::group(['prefix' => 'admin/faculty-information', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar']], function() {
        Route::get('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
        Route::post('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
        Route::post('modal-data', 'Control_Panel\FacultyController@modal_data')->name('admin.faculty_information.modal_data');
        Route::post('save-data', 'Control_Panel\FacultyController@save_data')->name('admin.faculty_information.save_data');
        Route::post('deactivate-data', 'Control_Panel\FacultyController@deactivate_data')->name('admin.faculty_information.deactivate_data');
        Route::post('additional-information', 'Control_Panel\FacultyController@additional_information')->name('admin.faculty_information.additional_information');

        Route::post('e-signature', 'Control_Panel\FacultyController@change_esignature')->name('admin.faculty.e_signature');
    });

    Route::group(['prefix' => 'shared/faculty-class-schedule', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root', 'registrar']], function() {
        Route::get('', 'Control_Panel\ClassScheduleController@index')->name('shared.faculty_class_schedules.index');
        Route::post('', 'Control_Panel\ClassScheduleController@index')->name('shared.faculty_class_schedules.index');
        Route::post('get-faculty-class-schedule', 'Control_Panel\ClassScheduleController@get_faculty_class_schedule')->name('shared.faculty_class_schedules.get_faculty_class_schedule');
        Route::get('print-handled-subject', 'Control_Panel\ClassScheduleController@print_handled_subject')->name('shared.faculty_class_schedules.print_handled_subject');
        Route::get('print-handled-subject-all', 'Control_Panel\ClassScheduleController@print_handled_subject_all')->name('shared.faculty_class_schedules.print_handled_subject_all');
    });