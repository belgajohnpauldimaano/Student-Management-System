<?php


// finance
Route::group(['prefix' => 'finance', 'middleware' => ['auth', 'userroles'], 'roles' => ['finance']], function () {
    
    Route::get('dashboard', 'Finance\FinanceDashboardController@index')->name('finance.dashboard');   

    Route::group(['prefix' => 'my-account', 'middleware' => ['auth']], function() {
        Route::get('', 'Finance\UserProfileController@view_my_profile')->name('finance.my_account.index');
        Route::post('update-profile', 'Finance\UserProfileController@update_profile')->name('finance.my_account.update_profile');
        Route::post('fetch-profile', 'Finance\UserProfileController@fetch_profile')->name('finance.my_account.fetch_profile');
        Route::post('change-my-photo', 'Finance\UserProfileController@change_my_photo')->name('finance.my_account.change_my_photo');
        Route::post('change-my-password', 'Finance\UserProfileController@change_my_password')->name('finance.my_account.change_my_password');
    });
    
    Route::group(['prefix' => 'student-information'], function (){
        Route::get('', 'Finance\StudentController@index')->name('finance.student_account');
        Route::post('', 'Finance\StudentController@index')->name('finance.student_account');
        Route::post('list-section', 'Finance\StudentController@listSection')->name('finance.list_section');
        Route::post('modal-data', 'Finance\StudentController@modal_data')->name('finance.student_account.modal');
        Route::post('modal-account', 'Finance\StudentController@modal_data')->name('finance.student_account.modal_account');
        Route::post('save-data', 'Finance\StudentController@save_data')->name('finance.student_account.save_data'); 
        
        Route::post('save', 'Finance\StudentController@save_modal_account')->name('finance.student_account.save_modal_account');
    });

    Route::get('', 'Finance\StudentClassListController@index')->name('finance.class_details');
    Route::post('', 'Finance\StudentClassListController@index')->name('finance.class_details');

    Route::group(['prefix' => 'student-class-list/{id}'], function() {        
        
        Route::get('', 'Finance\StudentClassListController@studentList')->name('finance.student_list');
        Route::post('', 'Finance\StudentClassListController@studentList')->name('finance.student_list');
        Route::post('enrolled-student', 'Finance\StudentClassListController@fetch_enrolled_student')->name('Finance.student_enrollment.fetch_enrolled_student');
        Route::get('enrolled-student', 'Registrar\StudentClassListController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');

        // Route::post('modal-data', 'Registrar\StudentEnrollmentController@modal_data')->name('registrar.student_enrollment.modal_data');
        // Route::post('save-data', 'Registrar\StudentEnrollmentController@save_data')->name('registrar.student_enrollment.save_data');
        // Route::post('enroll-student', 'Registrar\StudentEnrollmentController@enroll_student')->name('registrar.student_enrollment.enroll_student');
        // Route::post('re-enroll-student', 'Registrar\StudentEnrollmentController@re_enroll_student')->name('registrar.student_enrollment.re_enroll_student');
        // Route::post('re-enroll-student-all', 'Registrar\StudentEnrollmentController@re_enroll_student_all')->name('registrar.student_enrollment.re_enroll_student_all');
        // Route::post('enrolled-student', 'Registrar\StudentEnrollmentController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');
        // Route::get('enrolled-student', 'Registrar\StudentEnrollmentController@fetch_enrolled_student')->name('registrar.student_enrollment.fetch_enrolled_student');
        // Route::post('cancel-enroll-student', 'Registrar\StudentEnrollmentController@cancel_enroll_student')->name('registrar.student_enrollment.cancel_enroll_student');
        
        // Route::get('print-enrolled-students', 'Registrar\StudentEnrollmentController@print_enrolled_students')->name('registrar.student_enrollment.print_enrolled_students');
    });

    Route::group(['prefix' => 'student-payment'], function () {
        Route::get('not-yet-approved', 'Finance\StudentPaymentController@index')->name('finance.student_payment.not_yet_approved');
        Route::post('not-yet-approved', 'Finance\StudentPaymentController@index')->name('finance.student_payment.not_yet_approved');
        Route::get('approved', 'Finance\StudentPaymentController@approved')->name('finance.student_payment.approved');
        Route::post('approved', 'Finance\StudentPaymentController@approved')->name('finance.student_payment.approved');
        Route::get('disapproved', 'Finance\StudentPaymentController@disapproved')->name('finance.student_payment.disapproved');
        Route::post('disapproved', 'Finance\StudentPaymentController@disapproved')->name('finance.student_payment.disapproved');
        Route::post('approve', 'Finance\StudentPaymentController@approve')->name('finance.student_payment.approve');
        Route::post('disapprove', 'Finance\StudentPaymentController@disapprove')->name('finance.student_payment.disapprove');
        Route::post('modal-data', 'Finance\StudentPaymentController@modal_data')->name('finance.student_payment.modal');
        Route::post('modal-data-approved', 'Finance\StudentPaymentController@modal_data_approved')->name('finance.student_payment.modal_approved');
        Route::get('/export_excel/excel', 'Finance\StudentPaymentController@excel')->name('export_excel.excel');

        
    });

    Route::group(['prefix' => 'summary-payment'], function () {
        Route::get('', 'Finance\FinanceSummaryController@index')->name('finance.summary');
        Route::post('', 'Finance\FinanceSummaryController@index')->name('finance.summary');
        Route::post('report-summary', 'Finance\FinanceSummaryController@fetch_record')->name('finance.summary.fetch_record');
        Route::get('print', 'Finance\FinanceSummaryController@print')->name('finance.summary.print');
    });

    Route::group(['prefix' => 'summary-subsidy-discount'], function () {
        Route::get('', 'Finance\SubsidyDiscountController@index')->name('finance.summary.subsidy_discount');
        Route::post('', 'Finance\SubsidyDiscountController@index')->name('finance.summary.subsidy_discount');
        Route::post('report-subsidy-summary', 'Finance\SubsidyDiscountController@fetch_record')->name('finance.subsidy_discount.fetch_record');
        Route::get('print', 'Finance\SubsidyDiscountController@print')->name('finance.subsidy_discount.print');
    });

    Route::group(['prefix' => 'online-appointment'], function () {        
        Route::get('', 'Finance\Maintenance\OnlineAppointmentController@date_time')->name('finance.online_appointment.date_time');
        Route::post('', 'Finance\Maintenance\OnlineAppointmentController@date_time')->name('finance.online_appointment.date_time');
        Route::post('appointment', 'Finance\Maintenance\OnlineAppointmentController@show')->name('finance.online_appointment.show');
        Route::post('done', 'Finance\Maintenance\OnlineAppointmentController@done')->name('finance.online_appointment.done');
        Route::post('disapprove', 'Finance\Maintenance\OnlineAppointmentController@disapprove')->name('finance.online_appointment.disapprove');
        Route::post('deactivate', 'Finance\Maintenance\OnlineAppointmentController@deactivate_date')->name('finance.online_appointment.deactivate_date');
        Route::get('print', 'Finance\Maintenance\OnlineAppointmentController@print')->name('finance.online_appointment.print');
    });

    
    Route::group(['prefix' => 'student-finance-account'], function () {
        Route::get('', 'Finance\StudentFinanceAccountController@index')->name('finance.student_acct');
        Route::post('', 'Finance\StudentFinanceAccountController@index')->name('finance.student_acct');
        Route::post('paid', 'Finance\StudentFinanceAccountController@paid')->name('finance.student_acct.paid');
        Route::post('unpaid', 'Finance\StudentFinanceAccountController@unpaid')->name('finance.student_acct.unpaid');
        Route::post('modal-data', 'Finance\StudentFinanceAccountController@modal_data')->name('finance.student_acct.modal');
    });
    
    Route::group(['prefix' => 'student-payment-account'], function (){
        Route::get('', 'Finance\StudentAccountController@index')->name('finance.student_payment_account');
        Route::post('', 'Finance\StudentAccountController@index')->name('finance.student_payment_account');

        Route::post('modal-data', 'Finance\StudentAccountController@modal_data')->name('finance.student_payment_account.modal');
        Route::post('modal-data-edit', 'Finance\StudentAccountController@modal_data_edit')->name('finance.student_payment_account.modal_edit');
        Route::post('modal-data-others', 'Finance\StudentAccountController@modal_data_others')->name('finance.student_payment_account.modal_edit_others');
        Route::post('modal-data-discount', 'Finance\StudentAccountController@modal_data_discount')->name('finance.student_payment_account.modal_data_discount');

        Route::post('save-data', 'Finance\StudentAccountController@save_data')->name('finance.student_payment_account.save_data');
        Route::post('update-data', 'Finance\StudentAccountController@update_data')->name('finance.student_payment_account.update_data');
        Route::post('update-other', 'Finance\StudentAccountController@update_data_other')->name('finance.student_payment_account.update_other');
        Route::post('update-discount', 'Finance\StudentAccountController@update_data_discount')->name('finance.student_payment_account.update_data_discount');

        Route::post('save-data-others', 'Finance\StudentAccountController@save_others')->name('finance.student_payment_account.save_others');       
        Route::post('save-data-discount', 'Finance\StudentAccountController@save_discount')->name('finance.student_payment_account.save_discount');         
        
        Route::get('print-enrollment-bill', 'Finance\StudentAccountController@print_enrollment_bill')->name('finance.student_payment_account.print_enrollment_bill');
        Route::get('print-enrollment-bill', 'Finance\StudentAccountController@print_enrollment_bill')->name('finance.print_enrollment_bill');
        Route::get('print-other', 'Finance\StudentAccountController@print_other')->name('finance.student_payment_account.other');
        Route::get('print-all-transaction', 'Finance\StudentAccountController@print_all_transaction')->name('finance.print_all_transaction');

        Route::post('delete-data', 'Finance\StudentAccountController@data_delete')->name('finance.data_delete');
        Route::post('delete-transaction', 'Finance\StudentAccountController@deleteTransaction')->name('finance.delete_transaction');

        Route::post('delete-all-transaction', 'Finance\StudentAccountController@deleteEntireTransaction')->name('finance.delete_all_transaction');
    });

    Route::group(['prefix' => 'maintenance'], function () {
        Route::group(['prefix' => 'tuition-fee'], function () {
            Route::get('', 'Finance\Maintenance\TuitionFeeController@index')->name('finance.maintenance.tuition_fee');
            Route::post('', 'Finance\Maintenance\TuitionFeeController@index')->name('finance.maintenance.tuition_fee');
            Route::post('modal-data', 'Finance\Maintenance\TuitionFeeController@modal_data')->name('finance.maintenance.tuition_fee.modal_data');
            Route::post('save-data', 'Finance\Maintenance\TuitionFeeController@save_data')->name('finance.maintenance.tuition_fee.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\TuitionFeeController@deactivate_data')->name('finance.maintenance.tuition_fee.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\TuitionFeeController@toggle_current_sy')->name('finance.maintenance.tuition_fee.toggle_current_sy');
        });

        Route::group(['prefix' => 'downpayment-fee'], function () {
            Route::get('', 'Finance\Maintenance\DownpaymentController@index')->name('finance.maintenance.downpayment');
            Route::post('', 'Finance\Maintenance\DownpaymentController@index')->name('finance.maintenance.downpayment');
            Route::post('modal-data', 'Finance\Maintenance\DownpaymentController@modal_data')->name('finance.maintenance.downpayment.modal_data');
            Route::post('save-data', 'Finance\Maintenance\DownpaymentController@save_data')->name('finance.maintenance.downpayment.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\DownpaymentController@deactivate_data')->name('finance.maintenance.downpayment.deactivate_data');
            Route::post('modify', 'Finance\Maintenance\DownpaymentController@modify')->name('finance.maintenance.downpayment.modify');
            Route::post('toggle-current-sy', 'Finance\Maintenance\DownpaymentController@toggle_current_sy')->name('finance.maintenance.downpayment.toggle_current_sy');
        });

        Route::group(['prefix' => 'miscelleneous-fee'], function () {
            Route::get('', 'Finance\Maintenance\MiscelleneousFeeController@index')->name('finance.maintenance.misc_fee');
            Route::post('', 'Finance\Maintenance\MiscelleneousFeeController@index')->name('finance.maintenance.misc_fee');
            Route::post('modal-data', 'Finance\Maintenance\MiscelleneousFeeController@modal_data')->name('finance.maintenance.misc_fee.modal_data');
            Route::post('save-data', 'Finance\Maintenance\MiscelleneousFeeController@save_data')->name('finance.maintenance.misc_fee.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\MiscelleneousFeeController@deactivate_data')->name('finance.maintenance.misc_fee.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\MiscelleneousFeeController@toggle_current_sy')->name('finance.maintenance.misc_fee.toggle_current_sy');
        });

        Route::group(['prefix' => 'discount-fee'], function () {
            Route::get('', 'Finance\Maintenance\DiscountFeeController@index')->name('finance.maintenance.disc_fee');
            Route::post('', 'Finance\Maintenance\DiscountFeeController@index')->name('finance.maintenance.disc_fee');
            Route::post('modal-data', 'Finance\Maintenance\DiscountFeeController@modal_data')->name('finance.maintenance.disc_fee.modal_data');
            Route::post('save-data', 'Finance\Maintenance\DiscountFeeController@save_data')->name('finance.maintenance.disc_fee.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\DiscountFeeController@deactivate_data')->name('finance.maintenance.disc_fee.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\DiscountFeeController@toggle_current_sy')->name('finance.maintenance.disc_fee.toggle_current_sy');
        });

        Route::group(['prefix' => 'subsidy-fee'], function () {
            Route::get('', 'Finance\Maintenance\SubsidyFeeController@index')->name('finance.maintenance.subsidy');
            Route::post('', 'Finance\Maintenance\SubsidyFeeController@index')->name('finance.maintenance.subsidy');
            Route::post('modal-data', 'Finance\Maintenance\SubsidyFeeController@modal_data')->name('finance.maintenance.subsidy.modal_data');
            Route::post('save-data', 'Finance\Maintenance\SubsidyFeeController@save_data')->name('finance.maintenance.subsidy.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\SubsidyFeeController@deactivate_data')->name('finance.maintenance.subsidy.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\SubsidyFeeController@toggle_current_sy')->name('finance.maintenance.subsidy.toggle_current_sy');
        });

        Route::group(['prefix' => 'payment-category'], function () {
            Route::get('', 'Finance\Maintenance\PaymentCategoryController@index')->name('finance.maintenance.payment_category');
            Route::post('', 'Finance\Maintenance\PaymentCategoryController@index')->name('finance.maintenance.payment_category');
            Route::post('modal-data', 'Finance\Maintenance\PaymentCategoryController@modal_data')->name('finance.maintenance.payment_category.modal_data');
            Route::post('save-data', 'Finance\Maintenance\PaymentCategoryController@save_data')->name('finance.maintenance.payment_category.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\PaymentCategoryController@deactivate_data')->name('finance.maintenance.payment_category.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\PaymentCategoryController@toggle_current_sy')->name('finance.maintenance.payment_category.toggle_current_sy');
        });

        Route::group(['prefix' => 'other-fee'], function () {
            Route::get('', 'Finance\Maintenance\OtherFeeController@index')->name('finance.maintenance.other_fee');
            Route::post('', 'Finance\Maintenance\OtherFeeController@index')->name('finance.maintenance.other_fee');
            Route::post('modal-data', 'Finance\Maintenance\OtherFeeController@modal_data')->name('finance.maintenance.other_fee.modal_data');
            Route::post('save-data', 'Finance\Maintenance\OtherFeeController@save_data')->name('finance.maintenance.other_fee.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\OtherFeeController@deactivate_data')->name('finance.maintenance.other_fee.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\OtherFeeController@toggle_current_sy')->name('finance.maintenance.other_fee.toggle_current_sy');
        
        });

        Route::group(['prefix' => 'setup-queue'], function () {
            Route::get('', 'Finance\Maintenance\OnlineAppointmentController@index')->name('finance.maintenance.queue');
            Route::post('', 'Finance\Maintenance\OnlineAppointmentController@index')->name('finance.maintenance.queue');
            Route::post('modal-data', 'Finance\Maintenance\OnlineAppointmentController@modal_data')->name('finance.maintenance.queue.modal_data');
            Route::post('save-data', 'Finance\Maintenance\OnlineAppointmentController@save_data')->name('finance.maintenance.queue.save_data');
            Route::post('deactivate-data', 'Finance\Maintenance\OnlineAppointmentController@deactivate_data')->name('finance.maintenance.queue.deactivate_data');
            Route::post('toggle-current-sy', 'Finance\Maintenance\OnlineAppointmentController@toggle_current_sy')->name('finance.maintenance.queue.toggle_current_sy');
        
        });
    });
});