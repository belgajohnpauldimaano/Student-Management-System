<?php

namespace App\Providers;

use App\Models\IncomingStudent;
use App\Models\RegistrationButton;
use App\Models\TransactionMonthPaid;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            $registration = RegistrationButton::whereId(1)->first()->is_enabled;
            return $view->with('data', $registration);
        });

        View::composer('control_panel.layouts.master', function ($view) {
            $IncomingStudentCount = IncomingStudent::where('approval', 'Not yet Approved')->count();
            return $view->with('IncomingStudentCount', $IncomingStudentCount);
        });

        View::composer('control_panel.layouts.master', function ($view) {
            $NotyetApprovedCount = TransactionMonthPaid::where('approval', 'Not yet Approved')->where('isSuccess', 1)->count();
            return $view->with('NotyetApprovedCount', $NotyetApprovedCount);
        });

    }
}