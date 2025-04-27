<?php

namespace Nassirian\TunnelManager\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Nassirian\TunnelManager\TunnelManagerServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            TunnelManagerServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('tunnel-manager.api_token', 'dummy-token');
        $app['config']->set('tunnel-manager.zone_id', 'dummy-zone-id');
        $app['config']->set('tunnel-manager.domain', 'example.com');
        $app['config']->set('tunnel-manager.tunnel_uuid', 'dummy-tunnel-uuid');
    }
}

{

}