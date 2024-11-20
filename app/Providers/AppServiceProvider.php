<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['th', 'en'])
                ->flags([
                    'th' => asset('assets/flags/th.svg'),
                    'en' => asset('assets/flags/us.svg'),
                ])
                // ->flagsOnly()
                ->displayLocale('th'); // also accepts a closure
        });
    }
}
