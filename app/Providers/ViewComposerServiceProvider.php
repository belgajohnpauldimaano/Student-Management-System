<?php

namespace App\Providers;

use App\Traits\HasSchoolYear;
use App\Models\IncomingStudent;
use App\Traits\hasNotYetApproved;
use App\Models\RegistrationButton;
use App\Traits\hasIncomingStudents;
use App\Models\TransactionMonthPaid;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    use HasSchoolYear, hasIncomingStudents, hasNotYetApproved;
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
        $year = date('Y');
        $SchoolYear = $this->schoolYearActiveStatus();
        
        View::composer('layouts.header', function ($view) {
            $registration = RegistrationButton::whereId(1)->first()->is_enabled;
            return $view->with('data', $registration);
        });

        View::composer('control_panel.layouts.master', function ($view) use($SchoolYear, $year) {
            
            $NotyetApprovedCount    = $this->notYetApproved();
            $IncomingStudentCount   = $this->IncomingStudentCount();
            return $view->with('IncomingStudentCount', $IncomingStudentCount)
                ->with('NotyetApprovedCount', $NotyetApprovedCount)
                ->with('SchoolYear', $SchoolYear)->with('year', $year);
        });

        View::composer('control_panel_student.layouts.master', function ($view) use($SchoolYear, $year) {
            return $view->with('SchoolYear', $SchoolYear)
                ->with('year', $year);;
        });

    }
}