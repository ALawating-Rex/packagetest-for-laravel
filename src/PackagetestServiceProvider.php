<?php

namespace Aex\Packagetest;

use Illuminate\Support\ServiceProvider;

class PackagetestServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'Packagetest');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/packagetest'),
            __DIR__.'/config/packagetest.php' => config_path('packagetest.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('packagetest', function ($app) {
            return new Packagetest($app['session'], $app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['packagetest'];
    }
}
