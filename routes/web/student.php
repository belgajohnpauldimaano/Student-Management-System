<?php

Route::group(['prefix' => 'student', 'middleware' => ['auth', 'userroles'], 'roles' => ['student']], function() {
    Route::get('dashboard', 'Control_Panel_Student\DashboardController@index')->name('student.dashboard');

    Route::group(['prefix' => 'enrollment'], function () {
        Route::get('', 'Control_Panel_Student\EnrollmentController@index')->name('student.enrollment.index');
    });

    Route::group(['prefix' => 'class-schedule'], function() {
        Route::get('', 'Control_Panel_Student\ClassScheduleController@index')->name('student.class_schedule.index');
        Route::post('', 'Control_Panel_Student\ClassScheduleController@index')->name('student.class_schedule.index');
    });
    Route::group(['prefix' => 'grade-sheet'], function() {
        Route::get('', 'Control_Panel_Student\GradeSheetController@index')->name('student.grade_sheet.index');
        Route::post('', 'Control_Panel_Student\GradeSheetController@index')->name('student.grade_sheet.index');
        Route::get('print-grades', 'Control_Panel_Student\GradeSheetController@print_grades')->name('student.grade_sheet.print_grades');
    });
    
    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Control_Panel_Student\AccountProfileController@view_my_profile')->name('student.my_account.index');
        // Route::post('change-my-password', 'Control_Panel_Student\AccountProfileController@change_my_password')->name('my_account.change_my_password');
        Route::post('update-profile', 'Control_Panel_Student\AccountProfileController@update_profile')->name('student.my_account.update_profile');
        Route::post('fetch-profile', 'Control_Panel_Student\AccountProfileController@fetch_profile')->name('student.my_account.fetch_profile');
        Route::post('change-my-photo', 'Control_Panel_Student\AccountProfileController@change_my_photo')->name('student.my_account.change_my_photo');
        Route::post('change-my-password', 'Control_Panel_Student\AccountProfileController@change_my_password')->name('student.my_account.change_my_password');
    });
});