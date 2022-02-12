<?php

namespace Filter;

use Illuminate\Support\ServiceProvider;
use Filter\app\Console\Commands\MakeFilter;

class LaravelFilterServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilter::class
            ]);
        }
    }
}
