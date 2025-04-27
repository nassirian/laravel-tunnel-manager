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
        $app['config']->set('tunnelmanager.api_token', 'dummy-token');
        $app['config']->set('tunnelmanager.zone_id', 'dummy-zone-id');
        $app['config']->set('tunnelmanager.domain', 'example.com');
        $app['config']->set('tunnelmanager.tunnel_uuid', 'dummy-tunnel-uuid');
    }
}

{

}