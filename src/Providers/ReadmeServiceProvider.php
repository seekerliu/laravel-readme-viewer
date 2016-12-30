<?php

namespace Seekerliu\Readme\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use Seekerliu\Readme\Services\ReadmeService;

class ReadmeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //publish configs.
        $this->publishes([
            __DIR__.'/../../config/readme.php' => config_path('readme.php'),
        ], 'readme');

        //load routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/readme.php');

        //load views
        $viewPath = __DIR__.'/../../resources/views';
        $this->loadViewsFrom($viewPath, 'readme');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // load config.
        $this->mergeConfigFrom(
            __DIR__.'/../../config/readme.php', 'readme'
        );

        // ReadmeService.
        $this->app->singleton('ReadmeService', function ($app)
        {
            return new ReadmeService();
        });
    }
}
