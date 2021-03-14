<?php

namespace App\Providers;

use App\Services\Transmissions\TransmissionService;
use App\Services\Transmissions\TransmissionServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(TransmissionServiceInterface::class, TransmissionService::class);
    }
}
