<?php

Route::group(['prefix' => 'faculty', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'faculty']], function() {
    Route::group(['namespace' => 'Faculty'], function(){
        
        Route::get('dashboard', 'FacultyDashboardController@index')->name('faculty.dashboard');

        Route::group(['prefix' => 'home'], function () {
            Route::post('', 'HomeController@index')->name('faculty.home');
            Route::get('', 'HomeController@index')->name('faculty.home');
            Route::get('create-assessment', 'HomeController@createAssessment')->name('faculty.assessment.create');
            Route::post('modal-data', 'HomeController@modal_data')->name('finance.home.modal_data');
        });

        Route::group(['prefix' => 'assessment'], function () {
            Route::post('', 'AssessmentController@index')->name('faculty.assessment');
            Route::get('', 'AssessmentController@index')->name('faculty.assessment');
            Route::post('modal-data', 'AssessmentController@modal_data')->name('faculty.assessment.modal_data');
        });
        // assessment per subject
        Route::group(['prefix' => 'assessment/subject/{class_subject_details_id}', 'middleware' => 'auth'], function () {
            Route::post('', 'AssessmentSubjectController@index')->name('faculty.assessment_subject');
            Route::get('', 'AssessmentSubjectController@index')->name('faculty.assessment_subject');
            Route::post('modal-data', 'AssessmentSubjectController@modal')->name('faculty.assessment_subject.modal_data');
            Route::get('create-assessment', 'AssessmentSubjectController@create')->name('faculty.assessment_subject.create');
            Route::get('edit-assessment', 'AssessmentSubjectController@edit')->name('faculty.assessment_subject.edit');
            Route::post('edit-assessment', 'AssessmentSubjectController@edit')->name('faculty.assessment_subject.edit');
            Route::post('save-data', 'AssessmentSubjectController@save')->name('faculty.assessment_subject.save_data');
        });
        // question
        Route::group(['prefix' => 'assessment/subject/questions/{class_subject_details_id}', 'middleware' => 'auth'], function () {
            Route::post('', 'QuestionController@index')->name('faculty.question');
            Route::get('', 'QuestionController@index')->name('faculty.question');
            Route::get('edit-question', 'QuestionController@edit')->name('faculty.question.edit');
            Route::get('archive', 'QuestionController@archiveIndex')->name('faculty.question.archiveIndex');
            Route::post('move-archive', 'QuestionController@archive')->name('faculty.question.archive');
            Route::post('data-delete', 'QuestionController@softDelete')->name('faculty.question.delete');
            Route::post('move-active', 'QuestionController@active')->name('faculty.question.active');
            // Route::post('modal-data', 'QuestionController@modal_data')->name('faculty.assessment.modal_data');
            Route::post('save-data', 'QuestionController@save')->name('faculty.question.save_data');
            Route::post('save-instruction', 'AssessmentInstructionController@saveInstruction')->name('faculty.instruction.save_data');
            Route::get('edit-assessment-instruction', 'AssessmentInstructionController@edit')->name('faculty.instruction.edit');
           
        });
               
        Route::group(['prefix' => 'subject-class'], function() {
            Route::get('', 'SubjectClassController@index')->name('faculty.subject_class');
            Route::post('list-class-subject-details', 'SubjectClassController@list_class_subject_details')->name('faculty.subject_class.list_class_subject_details');
            Route::post('list-students-by-class', 'SubjectClassController@list_students_by_class')->name('faculty.subject_class.list_students_by_class');
            Route::get('list-students-by-class-print', 'SubjectClassController@list_students_by_class_print')->name('faculty.subject_class.list_students_by_class_print');
        });

        Route::group(['prefix' => 'class-schedules'], function() {
            Route::get('', 'SubjectClassController@class_schedules')->name('faculty.faculty_class_schedules');
            Route::get('class-schedules-print', 'SubjectClassController@class_schedules_print')->name('faculty.faculty_class_schedules.class_schedules_print');
        });
        
        Route::group(['prefix' => 'student-grade-sheet'], function() {
            Route::get('', 'GradeSheetController@index')->name('faculty.student_grade_sheet');
            Route::post('list-class-subject-details', 'GradeSheetController@list_class_subject_details')->name('faculty.student_grade_sheet.list_class_subject_details');
            Route::post('list-students-by-class', 'GradeSheetController@list_students_by_class')->name('faculty.student_grade_sheet.list_students_by_class');
            Route::post('save-grade', 'GradeSheetController@save_grade')->name('faculty.student_grade_sheet.save_grade');
            Route::post('temporary-save-grade', 'GradeSheetController@temporary_save_grade')->name('faculty.student_grade_sheet.temporary_save_grade');
            Route::post('finalize-grade', 'GradeSheetController@finalize_grade')->name('faculty.student_grade_sheet.finalize_grade');
            Route::get('list-students-by-class-print', 'GradeSheetController@list_students_by_class_print')->name('faculty.student_grade_sheet.list_students_by_class_print');    
        
            Route::post('semester', 'GradeSheetController@semester')->name('faculty.student_grade_sheet.semester');
            Route::post('list-class-subject-details1', 'GradeSheetController@list_class_subject_details1')->name('faculty.student_grade_sheet.list_class_subject_details1');
            Route::post('list-students-by-class1', 'GradeSheetController@list_students_by_class1')->name('faculty.student_grade_sheet.list_students_by_class1');
            Route::get('list-students-by-class-senior-print', 'GradeSheetController@list_students_by_class_print_senior')->name('faculty.student_grade_sheet.list_students_by_class_print1');    
        
        });



        Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
            Route::get('', 'UserProfileController@view_my_profile')->name('faculty.my_account.index');
            // Route::post('change-my-password', 'UserProfileController@change_my_password')->name('my_account.change_my_password');
            Route::post('update-profile', 'UserProfileController@update_profile')->name('faculty.my_account.update_profile');
            Route::post('fetch-profile', 'UserProfileController@fetch_profile')->name('faculty.my_account.fetch_profile');
            Route::post('change-my-photo', 'UserProfileController@change_my_photo')->name('faculty.my_account.change_my_photo');
            Route::post('change-my-password', 'UserProfileController@change_my_password')->name('faculty.my_account.change_my_password');
            Route::post('educational-attainment', 'UserProfileController@educational_attainment')->name('faculty.my_account.educational_attainment');
            Route::post('educational-attainment-save', 'UserProfileController@educational_attainment_save')->name('faculty.my_account.educational_attainment_save');
            Route::post('educational-attainment-fetch-by-id', 'UserProfileController@educational_attainment_fetch_by_id')->name('faculty.my_account.educational_attainment_fetch_by_id');
            Route::post('educational-attainment-delete-by-id', 'UserProfileController@educational_attainment_delete_by_id')->name('faculty.my_account.educational_attainment_delete_by_id');
            
            Route::post('trainings-seminars', 'UserProfileController@trainings_seminars')->name('faculty.my_account.trainings_seminars');
            Route::post('fetch-training-seminar-by-id', 'UserProfileController@fetch_training_seminar_by_id')->name('faculty.my_account.fetch_training_seminar_by_id');
            Route::post('save-training-seminar', 'UserProfileController@save_training_seminar')->name('faculty.my_account.save_training_seminar');
            Route::post('delete-training-seminar-by-id', 'UserProfileController@delete_training_seminar_by_id')->name('faculty.my_account.delete_training_seminar_by_id');
            
        });

        Route::group(['prefix' => 'advisory-class'], function () {
            Route::get('', 'AdvisoryClassController@index')->name('faculty.advisory_class.index');

            Route::get('student-list', 'AdvisoryClassController@view_class_list')->name('faculty.advisory_class.view');
            Route::post('student-list', 'AdvisoryClassController@view_class_list')->name('faculty.advisory_class.view');
            Route::post('manage_attendance', 'AdvisoryClassController@manage_attendance')->name('faculty.advisory_class.manage_attendance');
            Route::post('view_edit','AdvisoryClassController@manage_demographic_profile')->name('faculty.advisory_class.demographic_profile');
            Route::post('save_attendance', 'AdvisoryClassController@save_attendance')->name('faculty.advisory_class.save_attendance');
            
            Route::get('print-class-grades', 'AdvisoryClassController@print_student_class_grades')->name('faculty.AdvisoryClass.print_grades');
        
        });

        

        Route::group(['prefix' => 'my-advisory-class'], function () {
            Route::get('', 'MyAdvisoryClassController@index')->name('faculty.my_advisory_class.index');
            Route::post('first-quarter', 'MyAdvisoryClassController@firstquarter')->name('faculty.MyAdvisoryClass.firstquarter');
            Route::post('second-quarter', 'MyAdvisoryClassController@secondquarter')->name('faculty.MyAdvisoryClass.secondquarter');
            Route::post('third-quarter', 'MyAdvisoryClassController@thirdquarter')->name('faculty.MyAdvisoryClass.thirdquarter');
            Route::post('fourth-quarter', 'MyAdvisoryClassController@fourthquarter')->name('faculty.MyAdvisoryClass.fourthquarter');
            Route::get('print-first-quarter', 'MyAdvisoryClassController@print_firstquarter')->name('faculty.MyAdvisoryClass.print_first_quarter');
            Route::get('print-second-quarter', 'MyAdvisoryClassController@print_secondquarter')->name('faculty.MyAdvisoryClass.print_second_quarter');
            Route::get('print-third-quarter', 'MyAdvisoryClassController@print_thirdquarter')->name('faculty.MyAdvisoryClass.print_third_quarter');
            Route::get('print-fourth-quarter', 'MyAdvisoryClassController@print_fourthquarter')->name('faculty.MyAdvisoryClass.print_fourth_quarter');

            Route::post('list-class-subject-details', 'MyAdvisoryClassController@list_class_subject_details')->name('faculty.MyAdvisoryClass.list_class_subject_details');

            Route::post('list_quarter-details', 'MyAdvisoryClassController@list_quarter')->name('faculty.MyAdvisoryClass.list_quarter');
            Route::post('list_quarter-sem-details', 'MyAdvisoryClassController@list_quarter_sem')->name('faculty.MyAdvisoryClass.list_quarter-sem-details');

            Route::post('first_sem_1quarter', 'MyAdvisoryClassController@first_sem_1quarter')->name('faculty.MyAdvisoryClass.first_sem_1quarter');
            Route::post('first_sem_2quarter', 'MyAdvisoryClassController@first_sem_2quarter')->name('faculty.MyAdvisoryClass.first_sem_2quarter');
            Route::post('second_sem_1quarter', 'MyAdvisoryClassController@first_sem_3quarter')->name('faculty.MyAdvisoryClass.first_sem_3quarter');
            Route::post('second_sem_2quarter', 'MyAdvisoryClassController@first_sem_4quarter')->name('faculty.MyAdvisoryClass.first_sem_4quarter');

            Route::get('first-sem/print-first-quarter', 'MyAdvisoryClassController@print_firstSem_1quarter')->name('faculty.MyAdvisoryClass.print_firstSem_firstq');
            Route::get('first-sem/print-second-quarter', 'MyAdvisoryClassController@print_firstSem_2quarter')->name('faculty.MyAdvisoryClass.print_firstSem_secondq');
            Route::get('second-sem/print-first-quarter', 'MyAdvisoryClassController@print_secondSem_1quarter')->name('faculty.MyAdvisoryClass.print_secondSem_firstq');
            Route::get('second-sem/print-second-quarter', 'MyAdvisoryClassController@print_secondSem_2quarter')->name('faculty.MyAdvisoryClass.print_secondSem_secondq');

            //average for junior
            Route::post('Junior/GradeSheet_Average', 'MyAdvisoryClassController@gradeSheetAverage')->name('faculty.Average');
            Route::get('Junior/first_second_Average/print', 'MyAdvisoryClassController@firstSecondGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_second_print_average');
            Route::get('Junior/first_third_Average/print', 'MyAdvisoryClassController@firstThirdGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_third_print_average');
            Route::get('Junior/first_fourth_Average/print', 'MyAdvisoryClassController@firstFourthGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_fourth_print_average');

            //average for senior
            Route::post('Senior/first_sem/GradeSheet_Average', 'MyAdvisoryClassController@seniorFirstSemGradeSheetAverage')->name('faculty.Average_Senior');
            Route::post('Senior/second_sem/GradeSheet_Average', 'MyAdvisoryClassController@seniorSecondSemGradeSheetAverage')->name('faculty.Average_Senior_Second_Sem');
            
            Route::get('Senior/first_sem_Average/print', 'MyAdvisoryClassController@first_sem_GradeSheetAverage_print')->name('faculty.MyAdvisoryClass.first_sem_print_average');
            Route::get('Senior/second_sem_Average/print', 'MyAdvisoryClassController@second_sem_GradeSheetAverage_print')->name('faculty.MyAdvisoryClass.second_sem_print_average');
            Route::get('Senior/Final_Average/print', 'MyAdvisoryClassController@finalGradeSheetAverage_print')->name('faculty.MyAdvisoryClass.final_print_average');

        });

        Route::group(['prefix' => 'student-gradesheet'], function () {
            Route::get('', 'StudentGradeSheetController@index')->name('faculty.student_gradesheet.index');
            Route::post('grade-sheet', 'StudentGradeSheetController@gradeSheet')->name('faculty.student_gradesheet.fetch_grades');
            Route::post('first-quarter', 'StudentGradeSheetController@firstquarter')->name('faculty.student_gradesheet.firstquarter');
            Route::post('second-quarter', 'StudentGradeSheetController@secondquarter')->name('faculty.student_gradesheet.secondquarter');
            Route::post('sem-quarter', 'StudentGradeSheetController@listQuarterSem')->name('faculty.student_gradesheet.list_quarter_sem');
            Route::get('print-gradesheet', 'StudentGradeSheetController@print')->name('faculty.student_grade_sheet.print');
        });

        Route::group(['prefix' => 'class-attendance'], function () {
            Route::get('encode-class-attendance', 'ClassAttendanceController@index')->name('faculty.class-attendance.index');
            Route::post('encode-class-attendance', 'ClassAttendanceController@index')->name('faculty.class-attendance.index');
            Route::post('', 'ClassAttendanceController@save_attendance')->name('faculty.save_class_attendance');
            Route::get('print-class-attendance', 'ClassAttendanceController@print_attendance')->name('faculty.print_attendance');
        });

        Route::group(['prefix' => 'encode_remarks'], function () {
            Route::get('encode-class-remarks', 'EncodeRemarkController@index')->name('faculty.encode-remarks.index');
            Route::post('encode-class-remarks', 'EncodeRemarkController@index')->name('faculty.encode-remarks.index');

            Route::post('', 'EncodeRemarkController@save')->name('faculty.encode-remarks.save');
            // Route::get('print-class-grades', 'EncodeRemarkController@print_student_class_grades')->name('faculty.encode-remarks.print_grades');
        });
        
        Route::group(['prefix' => 'class-demographic-profile'], function () {
            Route::get('encode-class-demographic-profile', 'DemographicProfileController@index')->name('faculty.class_demographic_profile.index');
            Route::post('', 'DemographicProfileController@save')->name('faculty.save_demographic');
        });

        Route::group(['prefix' => 'data-student'], function (){
            Route::get('create-data-grades', 'GradeSheetController@view_student_data')->name('faculty.DataStudent');
            Route::post('section-list', 'GradeSheetController@list_class_section')->name('faculty.SectionList');
            // Route::get('section-list', 'GradeSheetController@list_class_section')->name('faculty.SectionList');\
        });
    });
});