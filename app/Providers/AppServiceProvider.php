<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\App;
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
     * Réaliser avec ChatGPT pour comprendre le fonctionnement du reporting journalier
     */
    public function boot(): void
    {
        if (App::runningInConsole()) {
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);

                // Ton job ici : (exécution toutes les minutes pour test)
                $schedule->job(new \App\Jobs\DailyEventReportJob)->everyMinute();
            });
        }
    }
}
