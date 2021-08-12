<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//Clase para usar la paginación de bootstrap
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //usar paginación :
        Paginator::useBootstrap();
    }
}
