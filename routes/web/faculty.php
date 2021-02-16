<?php

Route::group(['prefix' => 'faculty', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'faculty']], function() {

    Route::get('dashboard', 'Faculty\FacultyDashboardController@index')->name('faculty.dashboard');

    Route::group(['prefix' => 'home'], function () {
        Route::post('', 'Faculty\HomeController@index')->name('faculty.home');
        Route::get('', 'Faculty\HomeController@index')->name('faculty.home');
        Route::get('create-assessment', 'Faculty\HomeController@createAssessment')->name('faculty.assessment.create');
        Route::post('modal-data', 'Faculty\HomeController@modal_data')->name('finance.home.modal_data');
    });

    Route::group(['prefix' => 'assessment'], function () {
        Route::post('', 'Faculty\AssessmentController@index')->name('faculty.assessment');
        Route::get('', 'Faculty\AssessmentController@index')->name('faculty.assessment');
        Route::post('modal-data', 'Faculty\AssessmentController@modal_data')->name('finance.assessment.modal_data');
    });

    Route::group(['prefix' => 'assessment/subject/{class_subject_details_id}', 'middleware' => 'auth'], function () {
        Route::post('', 'Faculty\AssessmentSubjectController@index')->name('faculty.assessment_subject');
        Route::get('', 'Faculty\AssessmentSubjectController@index')->name('faculty.assessment_subject');
        Route::post('modal-data', 'Faculty\AssessmentSubjectController@modal')->name('faculty.assessment_subject.modal_data');
        Route::get('create-assessment', 'Faculty\AssessmentSubjectController@create')->name('faculty.assessment_subject.create');
        Route::post('save-data', 'Faculty\AssessmentSubjectController@save')->name('faculty.assessment_subject.save_data');
    });
    
    Route::group(['prefix' => 'subject-class'], function() {
        Route::get('', 'Faculty\SubjectClassController@index')->name('faculty.subject_class');
        Route::post('list-class-subject-details', 'Faculty\SubjectClassController@list_class_subject_details')->name('faculty.subject_class.list_class_subject_details');
        Route::post('list-students-by-class', 'Faculty\SubjectClassController@list_students_by_class')->name('faculty.subject_class.list_students_by_class');
        Route::get('list-students-by-class-print', 'Faculty\SubjectClassController@list_students_by_class_print')->name('faculty.subject_class.list_students_by_class_print');
    });

    Route::group(['prefix' => 'class-schedules'], function() {
        Route::get('', 'Faculty\SubjectClassController@class_schedules')->name('faculty.faculty_class_schedules');
        Route::get('class-schedules-print', 'Faculty\SubjectClassController@class_schedules_print')->name('faculty.faculty_class_schedules.class_schedules_print');
    });
    
    Route::group(['prefix' => 'student-grade-sheet'], function() {
        Route::get('', 'Faculty\GradeSheetController@index')->name('faculty.student_grade_sheet');
        Route::post('list-class-subject-details', 'Faculty\GradeSheetController@list_class_subject_details')->name('faculty.student_grade_sheet.list_class_subject_details');
        Route::post('list-students-by-class', 'Faculty\GradeSheetController@list_students_by_class')->name('faculty.student_grade_sheet.list_students_by_class');
        Route::post('save-grade', 'Faculty\GradeSheetController@save_grade')->name('faculty.student_grade_sheet.save_grade');
        Route::post('temporary-save-grade', 'Faculty\GradeSheetController@temporary_save_grade')->name('faculty.student_grade_sheet.temporary_save_grade');
        Route::post('finalize-grade', 'Faculty\GradeSheetController@finalize_grade')->name('faculty.student_grade_sheet.finalize_grade');
        Route::get('list-students-by-class-print', 'Faculty\GradeSheetController@list_students_by_class_print')->name('faculty.student_grade_sheet.list_students_by_class_print');    
    
        Route::post('semester', 'Faculty\GradeSheetController@semester')->name('faculty.student_grade_sheet.semester');
        Route::post('list-class-subject-details1', 'Faculty\GradeSheetController@list_class_subject_details1')->name('faculty.student_grade_sheet.list_class_subject_details1');
        Route::post('list-students-by-class1', 'Faculty\GradeSheetController@list_students_by_class1')->name('faculty.student_grade_sheet.list_students_by_class1');
        Route::get('list-students-by-class-senior-print', 'Faculty\GradeSheetController@list_students_by_class_print_senior')->name('faculty.student_grade_sheet.list_students_by_class_print1');    
    
    });



    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Faculty\UserProfileController@view_my_profile')->name('faculty.my_account.index');
        // Route::post('change-my-password', 'Faculty\UserProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Faculty\UserProfileController@update_profile')->name('faculty.my_account.update_profile');
        Route::post('fetch-profile', 'Faculty\UserProfileController@fetch_profile')->name('faculty.my_account.fetch_profile');
        Route::post('change-my-photo', 'Faculty\UserProfileController@change_my_photo')->name('faculty.my_account.change_my_photo');
        Route::post('change-my-password', 'Faculty\UserProfileController@change_my_password')->name('faculty.my_account.change_my_password');
        Route::post('educational-attainment', 'Faculty\UserProfileController@educational_attainment')->name('faculty.my_account.educational_attainment');
        Route::post('educational-attainment-save', 'Faculty\UserProfileController@educational_attainment_save')->name('faculty.my_account.educational_attainment_save');
        Route::post('educational-attainment-fetch-by-id', 'Faculty\UserProfileController@educational_attainment_fetch_by_id')->name('faculty.my_account.educational_attainment_fetch_by_id');
        Route::post('educational-attainment-delete-by-id', 'Faculty\UserProfileController@educational_attainment_delete_by_id')->name('faculty.my_account.educational_attainment_delete_by_id');
        
        Route::post('trainings-seminars', 'Faculty\UserProfileController@trainings_seminars')->name('faculty.my_account.trainings_seminars');
        Route::post('fetch-training-seminar-by-id', 'Faculty\UserProfileController@fetch_training_seminar_by_id')->name('faculty.my_account.fetch_training_seminar_by_id');
        Route::post('save-training-seminar', 'Faculty\UserProfileController@save_training_seminar')->name('faculty.my_account.save_training_seminar');
        Route::post('delete-training-seminar-by-id', 'Faculty\UserProfileController@delete_training_seminar_by_id')->name('faculty.my_account.delete_training_seminar_by_id');
        
    });

    Route::group(['prefix' => 'advisory-class'], function () {
        Route::get('', 'Faculty\AdvisoryClassController@index')->name('faculty.advisory_class.index');

        Route::get('student-list', 'Faculty\AdvisoryClassController@view_class_list')->name('faculty.advisory_class.view');
        Route::post('student-list', 'Faculty\AdvisoryClassController@view_class_list')->name('faculty.advisory_class.view');
        Route::post('manage_attendance', 'Faculty\AdvisoryClassController@manage_attendance')->name('faculty.advisory_class.manage_attendance');
        Route::post('view_edit','Faculty\AdvisoryClassController@manage_demographic_profile')->name('faculty.advisory_class.demographic_profile');
        Route::post('save_attendance', 'Faculty\AdvisoryClassController@save_attendance')->name('faculty.advisory_class.save_attendance');
        
        Route::get('print-class-grades', 'Faculty\AdvisoryClassController@print_student_class_grades')->name('faculty.AdvisoryClass.print_grades');
       
    });

    

    Route::group(['prefix' => 'my-advisory-class'], function () {
        Route::get('', 'Faculty\MyAdvisoryClassController@index')->name('faculty.my_advisory_class.index');
        Route::post('first-quarter', 'Faculty\MyAdvisoryClassController@firstquarter')->name('faculty.MyAdvisoryClass.firstquarter');
        Route::post('second-quarter', 'Faculty\MyAdvisoryClassController@secondquarter')->name('faculty.MyAdvisoryClass.secondquarter');
        Route::post('third-quarter', 'Faculty\MyAdvisoryClassController@thirdquarter')->name('faculty.MyAdvisoryClass.thirdquarter');
        Route::post('fourth-quarter', 'Faculty\MyAdvisoryClassController@fourthquarter')->name('faculty.MyAdvisoryClass.fourthquarter');
        Route::get('print-first-quarter', 'Faculty\MyAdvisoryClassController@print_firstquarter')->name('faculty.MyAdvisoryClass.print_first_quarter');
        Route::get('print-second-quarter', 'Faculty\MyAdvisoryClassController@print_secondquarter')->name('faculty.MyAdvisoryClass.print_second_quarter');
        Route::get('print-third-quarter', 'Faculty\MyAdvisoryClassController@print_thirdquarter')->name('faculty.MyAdvisoryClass.print_third_quarter');
        Route::get('print-fourth-quarter', 'Faculty\MyAdvisoryClassController@print_fourthquarter')->name('faculty.MyAdvisoryClass.print_fourth_quarter');

        Route::post('list-class-subject-details', 'Faculty\MyAdvisoryClassController@list_class_subject_details')->name('faculty.MyAdvisoryClass.list_class_subject_details');

        Route::post('list_quarter-details', 'Faculty\MyAdvisoryClassController@list_quarter')->name('faculty.MyAdvisoryClass.list_quarter');
        Route::post('list_quarter-sem-details', 'Faculty\MyAdvisoryClassController@list_quarter_sem')->name('faculty.MyAdvisoryClass.list_quarter-sem-details');

        Route::post('first_sem_1quarter', 'Faculty\MyAdvisoryClassController@first_sem_1quarter')->name('faculty.MyAdvisoryClass.first_sem_1quarter');
        Route::post('first_sem_2quarter', 'Faculty\MyAdvisoryClassController@first_sem_2quarter')->name('faculty.MyAdvisoryClass.first_sem_2quarter');
        Route::post('second_sem_1quarter', 'Faculty\MyAdvisoryClassController@first_sem_3quarter')->name('faculty.MyAdvisoryClass.first_sem_3quarter');
        Route::post('second_sem_2quarter', 'Faculty\MyAdvisoryClassController@first_sem_4quarter')->name('faculty.MyAdvisoryClass.first_sem_4quarter');

        Route::get('first-sem/print-first-quarter', 'Faculty\MyAdvisoryClassController@print_firstSem_1quarter')->name('faculty.MyAdvisoryClass.print_firstSem_firstq');
        Route::get('first-sem/print-second-quarter', 'Faculty\MyAdvisoryClassController@print_firstSem_2quarter')->name('faculty.MyAdvisoryClass.print_firstSem_secondq');
        Route::get('second-sem/print-first-quarter', 'Faculty\MyAdvisoryClassController@print_secondSem_1quarter')->name('faculty.MyAdvisoryClass.print_secondSem_firstq');
        Route::get('second-sem/print-second-quarter', 'Faculty\MyAdvisoryClassController@print_secondSem_2quarter')->name('faculty.MyAdvisoryClass.print_secondSem_secondq');

        //average for junior
        Route::post('Junior/GradeSheet_Average', 'Faculty\MyAdvisoryClassController@gradeSheetAverage')->name('faculty.Average');
        Route::get('Junior/first_second_Average/print', 'Faculty\MyAdvisoryClassController@firstSecondGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_second_print_average');
        Route::get('Junior/first_third_Average/print', 'Faculty\MyAdvisoryClassController@firstThirdGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_third_print_average');
        Route::get('Junior/first_fourth_Average/print', 'Faculty\MyAdvisoryClassController@firstFourthGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_fourth_print_average');

        //average for senior
        Route::post('Senior/first_sem/GradeSheet_Average', 'Faculty\MyAdvisoryClassController@seniorFirstSemGradeSheetAverage')->name('faculty.Average_Senior');
        Route::post('Senior/second_sem/GradeSheet_Average', 'Faculty\MyAdvisoryClassController@seniorSecondSemGradeSheetAverage')->name('faculty.Average_Senior_Second_Sem');
        
        Route::get('Senior/first_sem_Average/print', 'Faculty\MyAdvisoryClassController@first_sem_GradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_sem_print_average');
        Route::get('Senior/second_sem_Average/print', 'Faculty\MyAdvisoryClassController@second_sem_GradeSheetAverage_print')->name('faculty.MyAdvisoryClass.second_sem_print_average');
        Route::get('Senior/Final_Average/print', 'Faculty\MyAdvisoryClassController@finalGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.final_print_average');

    });

    Route::group(['prefix' => 'student-gradesheet'], function () {
        Route::get('', 'Faculty\StudentGradeSheetController@index')->name('faculty.student_gradesheet.index');
        Route::post('grade-sheet', 'Faculty\StudentGradeSheetController@gradeSheet')->name('faculty.student_gradesheet.fetch_grades');
        Route::post('first-quarter', 'Faculty\StudentGradeSheetController@firstquarter')->name('faculty.student_gradesheet.firstquarter');
        Route::post('second-quarter', 'Faculty\StudentGradeSheetController@secondquarter')->name('faculty.student_gradesheet.secondquarter');
        Route::post('sem-quarter', 'Faculty\StudentGradeSheetController@listQuarterSem')->name('faculty.student_gradesheet.list_quarter_sem');
        Route::get('print-gradesheet', 'Faculty\StudentGradeSheetController@print')->name('faculty.student_grade_sheet.print');
    });

    Route::group(['prefix' => 'class-attendance'], function () {
        Route::get('encode-class-attendance', 'Faculty\ClassAttendanceController@index')->name('faculty.class-attendance.index');
        Route::post('encode-class-attendance', 'Faculty\ClassAttendanceController@index')->name('faculty.class-attendance.index');
        Route::post('', 'Faculty\ClassAttendanceController@save_attendance')->name('faculty.save_class_attendance');
        Route::get('print-class-attendance', 'Faculty\ClassAttendanceController@print_attendance')->name('faculty.print_attendance');
    });

    Route::group(['prefix' => 'encode_remarks'], function () {
        Route::get('encode-class-remarks', 'Faculty\EncodeRemarkController@index')->name('faculty.encode-remarks.index');
        Route::post('encode-class-remarks', 'Faculty\EncodeRemarkController@index')->name('faculty.encode-remarks.index');

        Route::post('', 'Faculty\EncodeRemarkController@save')->name('faculty.encode-remarks.save');
        // Route::get('print-class-grades', 'Faculty\EncodeRemarkController@print_student_class_grades')->name('faculty.encode-remarks.print_grades');
    });
    
    Route::group(['prefix' => 'class-demographic-profile'], function () {
        Route::get('encode-class-demographic-profile', 'Faculty\DemographicProfileController@index')->name('faculty.class_demographic_profile.index');
        Route::post('', 'Faculty\DemographicProfileController@save')->name('faculty.save_demographic');
    });

    Route::group(['prefix' => 'data-student'], function (){
        Route::get('create-data-grades', 'Faculty\GradeSheetController@view_student_data')->name('faculty.DataStudent');
        Route::post('section-list', 'Faculty\GradeSheetController@list_class_section')->name('faculty.SectionList');
        // Route::get('section-list', 'Faculty\GradeSheetController@list_class_section')->name('faculty.SectionList');\
    });

});