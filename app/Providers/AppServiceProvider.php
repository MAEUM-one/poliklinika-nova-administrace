<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentIcons\Facades\FilamentIcons;

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
        FilamentIcons::register('fontawesome')
            ->asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/solid.min.css')
            ->template('<i class="fas fa-{ ICON }"></i>')
            ->icons([
                "fas fa-eye"
            ])
            ->replace(['fas ', 'fa-'])
            ->save();
    }
}
