<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //$this->listenToQuery();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        ini_set('max_execution_time', 300);
    }

    public function listenToQuery() {
        \DB::listen(function ($query) {
            \Log::info($query->sql);
            \Log::info($query->bindings);
            \Log::info($query->time);
        });
    }
}
