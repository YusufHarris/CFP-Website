<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider

{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the Beneficiary Repository
        $this->app->bind(
            'App\Repositories\Main\Beneficiary\BeneficiaryInterface',
            'App\Repositories\Main\Beneficiary\BeneficiaryRepository'
        );
    }

}
