<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root']], function() {
    Route::group(['namespace' => 'Control_Panel'], function(){
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::post('reset-password', 'ResetPasswordController@reset')->name('admin.reset_password');

        Route::group(['prefix' => 'registrar-information'], function() {
            Route::get('', 'RegistrarController@index')->name('admin.registrar_information');
            Route::post('', 'RegistrarController@index')->name('admin.registrar_information');
            Route::post('modal-data', 'RegistrarController@modal_data')->name('admin.registrar_information.modal_data');
            Route::post('save-data', 'RegistrarController@save_data')->name('admin.registrar_information.save_data');
            Route::post('deactivate-data', 'RegistrarController@deactivate_data')->name('admin.registrar_information.deactivate_data');
        });

        Route::group(['prefix' => 'finance-information'], function() {
            Route::get('', 'FinanceController@index')->name('admin.finance_information');
            Route::post('', 'FinanceController@index')->name('admin.finance_information');
            Route::post('modal-data', 'FinanceController@modal_data')->name('admin.finance_information.modal_data');
            Route::post('save-data', 'FinanceController@save_data')->name('admin.finance_information.save_data');
            Route::post('deactivate-data', 'FinanceController@deactivate_data')->name('admin.finance_information.deactivate_data');
        });

        Route::group(['prefix' => 'examiner-information'], function() {
        Route::get('', 'ExaminerController@index')->name('admin.examiner_information');
        Route::post('', 'ExaminerController@index')->name('admin.examiner_information');
        Route::post('modal-data', 'ExaminerController@modal_data')->name('admin.examiner_information.modal_data');
        Route::post('save-data', 'ExaminerController@save_data')->name('admin.examiner_information.save_data');
        Route::post('deactivate-data', 'ExaminerController@deactivate_data')->name('admin.examiner_information.deactivate_data');
        });

        Route::group(['prefix' => 'admission-information'], function() {
        Route::get('', 'AdmissionController@index')->name('admin.admission_information');
        Route::post('', 'AdmissionController@index')->name('admin.admission_information');
        Route::post('modal-data', 'AdmissionController@modal_data')->name('admin.admission_information.modal_data');
        Route::post('save-data', 'AdmissionController@save_data')->name('admin.admission_information.save_data');
        Route::post('deactivate-data', 'AdmissionController@deactivate_data')->name('admin.admission_information.deactivate_data');
        });
        
        Route::group(['prefix' => 'transcript-of-record-archieve'], function() {
            Route::get('', 'TranscriptArchiveController@index')->name('admin.transcript_archieve');
            Route::post('', 'TranscriptArchiveController@index')->name('admin.transcript_archieve');
            Route::post('modal-data', 'TranscriptArchiveController@modal_data')->name('admin.transcript_archieve.modal_data');
            Route::post('save-transcript', 'TranscriptArchiveController@save_transcript')->name('admin.transcript_archieve.save_transcript');
            Route::post('delete-data', 'TranscriptArchiveController@delete_data')->name('admin.transcript_archieve.delete_data');
            Route::post('download-tor', 'TranscriptArchiveController@download_tor')->name('admin.transcript_archieve.download_tor');
        });
        
        Route::group(['prefix' => 'articles'], function() {
            Route::get('', 'ArticlesController@index')->name('admin.articles');
            Route::post('', 'ArticlesController@index')->name('admin.articles');
            Route::post('modal-data', 'ArticlesController@modal_data')->name('admin.articles.modal_data');
            Route::post('save-data', 'ArticlesController@save_data')->name('admin.articles.save_data');
        });
        
        Route::group(['prefix' => 'maintenance'], function() {
            Route::group(['prefix' => 'school-year'], function() {
                Route::get('', 'Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
                Route::post('', 'Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
                Route::post('modal-data', 'Maintenance\SchoolYearController@modal_data')->name('admin.maintenance.school_year.modal_data');
                Route::post('save-data', 'Maintenance\SchoolYearController@save_data')->name('admin.maintenance.school_year.save_data');
                Route::post('deactivate-data', 'Maintenance\SchoolYearController@deactivate_data')->name('admin.maintenance.school_year.deactivate_data');
                Route::post('toggle-current-sy', 'Maintenance\SchoolYearController@toggle_current_sy')->name('admin.maintenance.school_year.toggle_current_sy');

                Route::get('school-year-settings', 'Maintenance\SchoolYearController@schoolYearSettings')->name('admin.maintenance.school_year_settings');
                Route::post('school-year-settings', 'Maintenance\SchoolYearController@schoolYearSettings')->name('admin.maintenance.school_year_settings');
                Route::post('set-school-year', 'Maintenance\SchoolYearController@saveSchoolYear')->name('admin.maintenance.set_school_year');
            });

            Route::group(['prefix' => 'registration_button'], function () {
                Route::get('', 'Maintenance\RegistrationButtonController@index')->name('admin.maintenance.registration_button');
                Route::post('', 'Maintenance\RegistrationButtonController@index')->name('admin.maintenance.registration_button');
                Route::post('update', 'Maintenance\RegistrationButtonController@update')->name('admin.maintenance.registration_button.updated');
            });

            Route::group(['prefix' => 'semester'], function () {
                Route::get('', 'Maintenance\SemesterController@index')->name('admin.maintenance.semester');
                Route::post('', 'Maintenance\SemesterController@index')->name('admin.maintenance.semester');
                Route::post('toggle-current-sy', 'Maintenance\SemesterController@toggle_current_sy')->name('admin.maintenance.semester.toggle_current_sy');
            });

            Route::group(['prefix' => 'subjects'], function() {
                Route::get('', 'Maintenance\SubjectController@index')->name('admin.maintenance.subjects');
                Route::post('', 'Maintenance\SubjectController@index')->name('admin.maintenance.subjects');
                Route::post('modal-data', 'Maintenance\SubjectController@modal_data')->name('admin.maintenance.subjects.modal_data');
                Route::post('save-data', 'Maintenance\SubjectController@save_data')->name('admin.maintenance.subjects.save_data');
                Route::post('deactivate-data', 'Maintenance\SubjectController@deactivate_data')->name('admin.maintenance.subjects.deactivate_data');
            });
            
            Route::group(['prefix' => 'class-rooms'], function() {
                Route::get('', 'Maintenance\RoomController@index')->name('admin.maintenance.classrooms');
                Route::post('', 'Maintenance\RoomController@index')->name('admin.maintenance.classrooms');
                Route::post('modal-data', 'Maintenance\RoomController@modal_data')->name('admin.maintenance.classrooms.modal_data');
                Route::post('save-data', 'Maintenance\RoomController@save_data')->name('admin.maintenance.classrooms.save_data');
                Route::post('deactivate-data', 'Maintenance\RoomController@deactivate_data')->name('admin.maintenance.classrooms.deactivate_data');
            });

            Route::group(['prefix' => 'section-details'], function() {
                Route::get('', 'Maintenance\SectionController@index')->name('admin.maintenance.section_details');
                Route::post('', 'Maintenance\SectionController@index')->name('admin.maintenance.section_details');
                Route::post('modal-data', 'Maintenance\SectionController@modal_data')->name('admin.maintenance.section_details.modal_data');
                Route::post('save-data', 'Maintenance\SectionController@save_data')->name('admin.maintenance.section_details.save_data');
                Route::post('deactivate-data', 'Maintenance\SectionController@deactivate_data')->name('admin.maintenance.section_details.deactivate_data');
            });

            Route::group(['prefix' => 'date-remarks'], function () {
                Route::get('', 'Maintenance\DateRemarkController@index')->name('admin.maintenance.date_remarks_for_class_card');
                Route::post('', 'Maintenance\DateRemarkController@index')->name('admin.maintenance.date_remarks_for_class_card');
                Route::post('save-data', 'Maintenance\DateRemarkController@save_data')->name('admin.maintenance.date_remarks_for_class.save_data');
                Route::post('modal-data', 'Maintenance\DateRemarkController@modal_data')->name('admin.maintenance.date_remarks_for_class.modal_data');
            });

            Route::group(['prefix' => 'strand'], function () {
                Route::get('', 'Maintenance\StrandController@index')->name('admin.maintenance.strand');
                Route::post('', 'Maintenance\StrandController@index')->name('admin.maintenance.strand');
                Route::post('modal-data', 'Maintenance\StrandController@modal_data')->name('admin.maintenance.strand.modal_data');
                Route::post('save-data', 'Maintenance\StrandController@save_data')->name('admin.maintenance.strand.save_data');
            });


            Route::group(['prefix' => 'student_attendance'], function () {
                Route::get('', 'Maintenance\StudentAttendanceController@index')->name('admin.maintenance.student_attendance');
                Route::post('', 'Maintenance\StudentAttendanceController@index')->name('admin.maintenance.student_attendance');
                Route::post('modal-data', 'Maintenance\StudentAttendanceController@modal_data')->name('admin.maintenance.student_attendance.modal_data');
                Route::post('save-data', 'Maintenance\StudentAttendanceController@save_data')->name('admin.maintenance.student_attendance.save_data');
                Route::post('apply-to-student', 'Maintenance\StudentAttendanceController@apply')->name('admin.maintenance.student_attendance.apply');
                Route::post('deactivate-data', 'Maintenance\StudentAttendanceController@deactivate_data')->name('admin.maintenance.student_attendance.deactivate_data');
            });
        });
        
        Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
            Route::get('', 'UserProfileController@view_my_profile')->name('my_account.index');
            // Route::post('change-my-password', 'UserProfileController@change_my_password')->name('my_account.change_my_password');
            Route::post('update-profile', 'UserProfileController@update_profile')->name('my_account.update_profile');
            Route::post('fetch-profile', 'UserProfileController@fetch_profile')->name('my_account.fetch_profile');
            Route::post('change-my-photo', 'UserProfileController@change_my_photo')->name('my_account.change_my_photo');
            Route::post('change-my-password', 'UserProfileController@change_my_password')->name('my_account.change_my_password');
        });
    });
});