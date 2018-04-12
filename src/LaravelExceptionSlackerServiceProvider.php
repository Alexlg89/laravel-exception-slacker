<?php

namespace Alexlg89\LaravelExceptionSlacker;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;

class LaravelExceptionSlackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Bind Exception Handler
        $this->app->singleton(
            ExceptionHandler::class,
            ExceptionSlackHandler::class
        );

        $this->publishes([
            __DIR__.'/config/exception-slacker.php' => config_path('exception-slacker.php'),
        ]);

        parent::boot();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/exception-slacker.php',
            'exception-slacker'
        );
    }
}
