<?php

namespace App\Providers;

use App\Models\RegistrationButton;
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
    }
}