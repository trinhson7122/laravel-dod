<?php

namespace SonTX\LaravelDOD;

use Illuminate\Support\ServiceProvider;
use SonTX\LaravelDOD\Console\Commands\CreateActionCommand;
use SonTX\LaravelDOD\Console\Commands\CreateDTOCommand;
use SonTX\LaravelDOD\Console\Commands\CreateRepositoryCommand;
use SonTX\LaravelDOD\Console\Commands\CreateServiceCommand;
use SonTX\LaravelDOD\Console\Commands\CreateViewModelCommand;

class LaravelDODServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laraveldod.php' => config_path('laraveldod.php'),
        ], 'laravel-dod-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateActionCommand::class,
                CreateDTOCommand::class,
                CreateServiceCommand::class,
                CreateRepositoryCommand::class,
                CreateViewModelCommand::class,
            ]);
        }
    }

    public function register()
    {
        // \Illuminate\Support\Facades\Log::info('LaravelDODServiceProvider::register()');
    }
}
