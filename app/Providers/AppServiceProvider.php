<?php

namespace App\Providers;

use App\Models\Email;
use App\Models\SchoolYear;
// use App\Models\IncomingStudent;
use App\Observers\EmailObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
// use App\Observers\IncomingStudentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);  
        // IncomingStudent::observe(IncomingStudentObserver::class);
        Email::observe(EmailObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}