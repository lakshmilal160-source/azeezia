<?php

namespace App\Providers;

use App\Models\ConventionCentre;
use App\Models\Resort;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        try {
            if (Schema::hasTable('site_settings')) {
                View::share('siteSettings', SiteSetting::getAllSettings());
            } else {
                View::share('siteSettings', []);
            }
        } catch (\Throwable) {
            View::share('siteSettings', []);
        }

        View::composer(['frontend.partials.footer', 'frontend.contact'], function ($view) {
            try {
                $conventionContact = ConventionCentre::getContact();
            } catch (\Throwable) {
                $conventionContact = [
                    'name' => 'Azeezia Convention Centre',
                    'address' => 'Padukkad, Thrissur, Kerala 680005',
                    'phone' => '+91 88 76 64 3210',
                    'email' => 'events@azeezia.com',
                    'url' => 'https://maps.google.com/?q=Padukkad,Thrissur,Kerala',
                ];
            }

            try {
                $resortContact = Resort::getContact();
            } catch (\Throwable) {
                $resortContact = [
                    'name' => 'Azeezia Resort & 37-Acre Farm',
                    'resort_name' => 'Azeezia Resort',
                    'combined_name' => 'Azeezia Resort & Organic Farm',
                    'address' => 'Near Heritage Valley, Thrissur, Kerala 680005',
                    'phone' => '+91 75 94 95 0777',
                    'email' => 'farm@azeezia.com',
                    'url' => 'https://maps.google.com/?q=Thrissur,Kerala',
                ];
            }

            $view->with(compact('conventionContact', 'resortContact'));
        });
    }
}
