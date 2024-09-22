<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use App\Commands\CreateRepositoryCommand;
use App\Commands\CreateTraitCommand;
use App\Commands\CreateServiceCommand;
use App\Commands\CreateBladeCommand;

class LaravelMoreCommandProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $filePath = config_path('repositories.php');

        if ((new Filesystem())->exists($filePath)) {
            $repositories = config('repositories');

            foreach($repositories as $interface => $repository) {
                $this->app->singleton(
                    $interface,
                    $repository
                );
            }
        }

        $this->commands([
            CreateRepositoryCommand::class,
            CreateTraitCommand::class,
            CreateServiceCommand::class,
            CreateBladeCommand::class,
        ]);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-more-command.php' => config_path('laravel-more-command.php'),
        ], 'config');
    }
}
