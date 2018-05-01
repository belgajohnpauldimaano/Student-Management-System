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
    echo 'eee';
    return;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'registrar', 'middleware' => ['auth', 'userroles'], 'roles' => ['registrar']], function() {
    Route::get('dashboard', 'Registrar\RegistrarDashboardController@index')->name('registrar.dashboard');

    Route::group(['prefix' => 'class-details', 'middleware' => 'auth'], function() {
        Route::get('', 'Registrar\ClassListController@index')->name('registrar.class_details');
        Route::post('', 'Registrar\ClassListController@index')->name('registrar.class_details');
        Route::post('modal-data', 'Registrar\ClassListController@modal_data')->name('registrar.class_details.modal_data');
        Route::post('save-data', 'Registrar\ClassListController@save_data')->name('registrar.class_details.save_data');
        Route::post('deactivate-data', 'Registrar\ClassListController@deactivate_data')->name('registrar.class_details.deactivate_data');
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
    
});


Route::group(['prefix' => 'faculty'], function() {
    //
    Route::get('dashboard', 'Faculty\FacultyDashboardController@index')->name('faculty.dashboard');
});



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'userroles'], 'roles' => ['admin', 'root']], function() {
    Route::get('dashboard', 'Control_Panel\DashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'faculty-information'], function() {
        Route::get('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
        Route::post('', 'Control_Panel\FacultyController@index')->name('admin.faculty_information');
        Route::post('modal-data', 'Control_Panel\FacultyController@modal_data')->name('admin.faculty_information.modal_data');
        Route::post('save-data', 'Control_Panel\FacultyController@save_data')->name('admin.faculty_information.save_data');
        Route::post('deactivate-data', 'Control_Panel\FacultyController@deactivate_data')->name('admin.faculty_information.deactivate_data');
    });

    Route::group(['prefix' => 'registrar-information'], function() {
        Route::get('', 'Control_Panel\RegistrarController@index')->name('admin.registrar_information');
        Route::post('', 'Control_Panel\RegistrarController@index')->name('admin.registrar_information');
        Route::post('modal-data', 'Control_Panel\RegistrarController@modal_data')->name('admin.registrar_information.modal_data');
        Route::post('save-data', 'Control_Panel\RegistrarController@save_data')->name('admin.registrar_information.save_data');
        Route::post('deactivate-data', 'Control_Panel\RegistrarController@deactivate_data')->name('admin.registrar_information.deactivate_data');
    });

    Route::group(['prefix' => 'student-information'], function() {
        Route::get('', 'Control_Panel\StudentController@index')->name('admin.student.information');
        Route::post('', 'Control_Panel\StudentController@index')->name('admin.student.information');
        Route::post('modal-data', 'Control_Panel\StudentController@modal_data')->name('admin.student.information.modal_data');
        Route::post('save-data', 'Control_Panel\StudentController@save_data')->name('admin.student.information.save_data');
        Route::post('deactivate-data', 'Control_Panel\StudentController@deactivate_data')->name('admin.student.information.deactivate_data');
    });
    
    Route::group(['prefix' => 'maintenance'], function() {
        Route::group(['prefix' => 'school-year'], function() {
            Route::get('', 'Control_Panel\Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
            Route::post('', 'Control_Panel\Maintenance\SchoolYearController@index')->name('admin.maintenance.school_year');
            Route::post('modal-data', 'Control_Panel\Maintenance\SchoolYearController@modal_data')->name('admin.maintenance.school_year.modal_data');
            Route::post('save-data', 'Control_Panel\Maintenance\SchoolYearController@save_data')->name('admin.maintenance.school_year.save_data');
            Route::post('deactivate-data', 'Control_Panel\Maintenance\SchoolYearController@deactivate_data')->name('admin.maintenance.school_year.deactivate_data');
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
    
});


