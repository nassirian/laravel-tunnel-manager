<?php
namespace Nassirian\TunnelManager;

use Illuminate\Support\ServiceProvider;
use Nassirian\TunnelManager\Console\Commands\AddTunnelSubdomain;

class TunnelManagerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tunnel-manager.php', 'tunnel-manager'
        );
    }

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/tunnel-manager.php' => config_path('tunnel-manager.php'),
            ], 'tunnel-manager-config');
            $this->commands([
                AddTunnelSubdomain::class,
            ]);
        }
    }
}

