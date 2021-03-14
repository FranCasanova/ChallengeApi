<?php

namespace App\Providers;

use App\Repositories\Transmissions\TransmissionRepository;
use App\Repositories\Transmissions\TransmissionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(TransmissionRepositoryInterface::class, TransmissionRepository::class);
    }
}
