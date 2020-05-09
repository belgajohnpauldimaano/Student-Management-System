<?php

/*
|About SJA Pages --------------------------------------------------------------------------
*/
Route::group(['as' => 'front-end.'], function () {    

    Route::get('/school-profile', 'AboutController@school_profile')->name('school_profile');
    Route::get('/vision-mission', 'AboutController@vision_mission')->name('vision_mission');
    Route::get('/philosophy', 'AboutController@philosophy')->name('philosophy');
    Route::get('/history', 'AboutController@history')->name('history');
    Route::get('/hymn', 'AboutController@hymn')->name('hymn');
    Route::get('/award-and-recognition', 'AboutController@award_recognition')->name('award_recognition');
    Route::get('/administration-and-offices', 'AboutController@administration_offices')->name('administration_offices');
    Route::get('/faculty-and-staff', 'AboutController@faculty_staff')->name('faculty_staff');

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
});