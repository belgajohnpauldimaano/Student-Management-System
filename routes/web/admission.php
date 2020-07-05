<?php

Route::group(['prefix' => 'admission', 'middleware' => ['auth', 'userroles'], 'roles' => ['admission']], function() {
    Route::get('dashboard', 'Admission\AdmissionDashboardController@index')->name('admission.dashboard');

    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Admission\UserProfileController@view_my_profile')->name('admission.my_account.index');
        // Route::post('change-my-password', 'admission\UserProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Admission\UserProfileController@update_profile')->name('admission.my_account.update_profile');
        Route::post('fetch-profile', 'Admission\UserProfileController@fetch_profile')->name('admission.my_account.fetch_profile');
        Route::post('change-my-photo', 'Admission\UserProfileController@change_my_photo')->name('admission.my_account.change_my_photo');
        Route::post('change-my-password', 'Admission\UserProfileController@change_my_password')->name('admission.my_account.change_my_password');
    });
    
    // Route::group(['prefix' => 'student-grade-sheet'], function() {
    //     Route::get('', 'Registrar\GradeSheetController@index')->name('registrar.student_grade_sheet');
    //     Route::post('list-class-subject-details', 'Registrar\GradeSheetController@list_class_subject_details')->name('registrar.student_grade_sheet.list_class_subject_details');
    //     Route::post('list-students-by-class', 'Registrar\GradeSheetController@list_students_by_class')->name('registrar.student_grade_sheet.list_students_by_class');
    // });

    Route::group(['prefix' => 'incoming-student', 'middleware' => 'auth', 'roles' => ['admin', 'root', 'admission']], function() {
        Route::get('', 'Admission\NotYetApprovedController@index')->name('admission.incoming_student');
        Route::post('', 'Admission\NotYetApprovedController@index')->name('admission.incoming_student');
    
        // Route::get('Approved', 'Registrar\IncomingStudentController@Approved')->name('registrar.Approved');
        // Route::post('Approved', 'Registrar\IncomingStudentController@Approved')->name('registrar.Approved');
    
        // Route::get('Disapproved', 'Registrar\IncomingStudentController@Disapproved')->name('registrar.Disapproved');
        // Route::post('Disapproved', 'Registrar\IncomingStudentController@Disapproved')->name('registrar.Disapproved');
    
        // Route::post('modal', 'Registrar\IncomingStudentController@modal_data')->name('registrar.incoming_student.modal');
        // Route::post('approve', 'Registrar\IncomingStudentController@approve')->name('registrar.incoming_student.approve');
        // Route::post('disapprove', 'Registrar\IncomingStudentController@disapprove')->name('registrar.incoming_student.disapprove');
        // Route::post('enroll-student', 'Registrar\IncomingStudentController@enroll_student')->name('registrar.incoming_student.enroll_student');
    });
    
});

