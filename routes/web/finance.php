<?php


// finance
Route::group(['prefix' => 'finance', 'middleware' => ['auth', 'userroles'], 'roles' => ['finance']], function () {
    
    Route::get('dashboard', 'Finance\FinanceDashboardController@index')->name('finance.dashboard');
    
    Route::group(['prefix' => 'student-information'], function (){
        Route::get('', 'Finance\StudentController@index')->name('finance.student_account');
        Route::post('', 'Finance\StudentController@index')->name('finance.student_account');
        Route::post('modal-data', 'Finance\StudentController@modal_data')->name('finance.student_account.modal');
        Route::post('modal-account', 'Finance\StudentController@modal_data')->name('finance.student_account.modal_account');
        Route::post('save-data', 'Finance\StudentController@save_data')->name('finance.student_account.save_data'); 
        Route::get('print-enrollment-bill', 'Finance\StudentController@print_enrollment_bill')->name('finance.print_enrollment_bill');
        Route::post('save', 'Finance\StudentController@save_modal_account')->name('finance.student_account.save_modal_account');
    });

    Route::group(['prefix' => 'student-payment'], function () {
        Route::get('', 'Finance\StudentPaymentController@index')->name('finance.student_payment');
        Route::post('', 'Finance\StudentPaymentController@index')->name('finance.student_payment');
        Route::post('approve', 'Finance\StudentPaymentController@approve')->name('finance.student_payment.approve');
        Route::post('disapprove', 'Finance\StudentPaymentController@disapprove')->name('finance.student_payment.disapprove');
        Route::post('modal-data', 'Finance\StudentPaymentController@modal_data')->name('finance.student_payment.modal');
    });

    Route::group(['prefix' => 'student-finance-account'], function () {
        Route::get('', 'Finance\StudentFinanceAccountController@index')->name('finance.student_acct');
        Route::post('', 'Finance\StudentFinanceAccountController@index')->name('finance.student_acct');
        // Route::post('approve', 'Finance\StudentFinanceAccountController@approve')->name('finance.student_acct.approve');
        // Route::post('disapprove', 'Finance\StudentFinanceAccountController@approve')->name('finance.student_acct.disapprove');
        Route::post('modal-data', 'Finance\StudentFinanceAccountController@modal_data')->name('finance.student_acct.modal');
    });
    
    Route::group(['prefix' => 'student-payment-account'], function (){
        Route::get('', 'Finance\StudentAccountController@index')->name('finance.student_payment_account');
        Route::post('', 'Finance\StudentAccountController@index')->name('finance.student_payment_account');
        Route::post('modal-data', 'Finance\StudentAccountController@modal_data')->name('finance.student_payment_account.modal');
        Route::post('save-data', 'Finance\StudentAccountController@save_data')->name('finance.student_payment_account.save_data');
        Route::post('save-data-others', 'Finance\StudentAccountController@save_others')->name('finance.student_payment_account.save_others');        
        Route::get('print-enrollment-bill', 'Finance\StudentAccountController@print_enrollment_bill')->name('finance.student_payment_account.print_enrollment_bill');
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
    });
});