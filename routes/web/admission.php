<?php

Route::group(['prefix' => 'admission', 'middleware' => ['auth', 'userroles'], 'roles' => ['admission']], function() {
    Route::group(['namespace' => 'Admission'], function(){
        Route::get('dashboard', 'AdmissionDashboardController@index')->name('admission.dashboard');

        Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
            Route::get('', 'UserProfileController@view_my_profile')->name('admission.my_account.index');
            // Route::post('change-my-password', 'admission\UserProfileController@change_my_password')->name('my_account.change_my_password');
            Route::post('update-profile', 'UserProfileController@update_profile')->name('admission.my_account.update_profile');
            Route::post('fetch-profile', 'UserProfileController@fetch_profile')->name('admission.my_account.fetch_profile');
            Route::post('change-my-photo', 'UserProfileController@change_my_photo')->name('admission.my_account.change_my_photo');
            Route::post('change-my-password', 'UserProfileController@change_my_password')->name('admission.my_account.change_my_password');
        });

         Route::group(['prefix' => 'incoming-student', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'admission']], function() {
            Route::get('', 'IncomingStudentController@index')->name('admission.incoming');
            Route::post('', 'IncomingStudentController@index')->name('admission.incoming');
            Route::post('modal', 'IncomingStudentController@modal_data')->name('admission.incoming.modal');
            Route::post('approve', 'IncomingStudentController@approve')->name('admission.incoming.approve');
            Route::post('disapprove', 'IncomingStudentController@disapprove')->name('admission.incoming.disapprove');
            Route::get('/export_excel/excel', 'IncomingStudentController@excel')->name('export_excel.excel.admission');
        });
            
        // Route::group(['prefix' => 'student-grade-sheet'], function() {
        //     Route::get('', 'Registrar\GradeSheetController@index')->name('registrar.student_grade_sheet');
        //     Route::post('list-class-subject-details', 'Registrar\GradeSheetController@list_class_subject_details')->name('registrar.student_grade_sheet.list_class_subject_details');
        //     Route::post('list-students-by-class', 'Registrar\GradeSheetController@list_students_by_class')->name('registrar.student_grade_sheet.list_students_by_class');
        // });
    });
});