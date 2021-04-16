<?php

// student
Route::group(['prefix' => 'student', 'middleware' => ['auth', 'userroles'], 'roles' => ['student']], function() {
    Route::group(['namespace' => 'Control_Panel_Student'], function(){
        Route::get('dashboard', 'DashboardController@index')->name('student.dashboard');

        Route::group(['prefix' => 'enrollment'], function () {
            Route::get('', 'EnrollmentController@index')->name('student.enrollment.index');
            Route::post('', 'EnrollmentController@index')->name('student.enrollment.index');
            Route::post('save-data', 'EnrollmentController@save')->name('student.enrollment.save_data');
            Route::post('save', 'EnrollmentController@save_data')->name('student.enrollment.save');
            Route::post('modal-account', 'EnrollmentController@modal_data')->name('student.transaction_history.modal_account');
            
            // checkout
            Route::post('/check-out', 'PaymentController@createPayment')->name('student.create-payment.paypal');
            Route::get('confirm', 'PaymentController@confirmPayment')->name('confirm-payment');
            Route::post('/notify-student', 'PaymentController@paypalPdt');        
        });
    
        // assessment
        Route::group(['prefix' => 'assessment'], function(){
            Route::get('subject-list', 'AssessmentController@index')->name('student.assessment.index');
        });

        Route::group(['prefix' => 'assessment/subject/{id}'], function(){
            Route::get('subject-details', 'AssessmentController@subject')->name('student.assessment.subject.details');
            Route::post('subject-details', 'AssessmentController@subject')->name('student.assessment.subject.details');
            Route::get('get-data', 'AssessmentController@getAssessmentData')->name('student.assessment.get.data');
            Route::get('take-assessment', 'AssessmentController@takeAssessment')->name('student.take.assessment');
            Route::post('take-assessment', 'AssessmentController@takeAssessment')->name('student.take.assessment');
            Route::post('redirect-assessment', 'AssessmentController@redirectAssessment')->name('student.redirect.assessment');
            Route::get('redirect-assessment', 'AssessmentController@redirectAssessment')->name('student.redirect.assessment');
            Route::post('save-data', 'AssessmentController@save')->name('student.save.assessment');
        });
        
        // Route::post('paypal', 'PaymentController@payWithpaypal');
        // Route::get('status', 'PaymentController@getPaymentStatus');

        Route::group(['prefix' => 'class-schedule'], function() {
            Route::get('', 'ClassScheduleController@index')->name('student.class_schedule.index');
            Route::post('', 'ClassScheduleController@index')->name('student.class_schedule.index');
        });
        
        Route::group(['prefix' => 'grade-sheet'], function() {
            Route::get('', 'GradeSheetController@index')->name('student.grade_sheet.index');
            Route::post('', 'GradeSheetController@index')->name('student.grade_sheet.index');
            Route::get('print-grades', 'GradeSheetController@print_grades')->name('student.grade_sheet.print_grades');
        });
        
        Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
            Route::get('', 'AccountProfileController@view_my_profile')->name('student.my_account.index');
            // Route::post('change-my-password', 'AccountProfileController@change_my_password')->name('my_account.change_my_password');
            Route::post('update-profile', 'AccountProfileController@update_profile')->name('student.my_account.update_profile');
            Route::post('fetch-profile', 'AccountProfileController@fetch_profile')->name('student.my_account.fetch_profile');
            Route::post('change-my-photo', 'AccountProfileController@change_my_photo')->name('student.my_account.change_my_photo');
            Route::post('change-my-password', 'AccountProfileController@change_my_password')->name('student.my_account.change_my_password');
        });

    });

     Route::group(['prefix' => 'online-appointment'], function(){
        Route::get('', 'Finance\Maintenance\OnlineAppointmentController@appointment')->name('student.student_appointment');
        Route::post('', 'Finance\Maintenance\OnlineAppointmentController@appointment')->name('student.student_appointment');
        Route::post('reserve', 'Finance\Maintenance\OnlineAppointmentController@reserve')->name('student.student_appointment.reserve');
    });
});