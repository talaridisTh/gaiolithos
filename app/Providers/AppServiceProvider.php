<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\ImageManipulation;
use Intervention\Image\Image;
use Illuminate\Support\ServiceProvider;

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
        //


        Paginator::useBootstrap();
    }
}
