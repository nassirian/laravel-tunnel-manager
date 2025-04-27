<?php
namespace Nassirian\TunnelManager\Tests;


use Illuminate\Support\Facades\Http;
use Nassirian\TunnelManager\TunnelManagerServiceProvider;

class AddTunnelSubdomainTest extends TestCase
{

    /** @test */
    public function test_it_creates_dns_record_successfully()
    {
        Http::fake([
            'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
                'success' => true,
            ], 200),
        ]);

        $this->artisan('tunnel:add-subdomain', ['subdomain' => 'testsub'])
            ->expectsOutput('✅ Subdomain testsub.example.com created successfully!')
            ->assertExitCode(0);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.cloudflare.com/client/v4/zones/dummy-zone-id/dns_records'
                && $request->method() === 'POST'
                && $request['type'] === 'CNAME'
                && $request['name'] === 'testsub.example.com'
                && $request['content'] === 'dummy-tunnel-uuid.cfargotunnel.com';
        });
    }

    /** @test */
    public function test_it_handles_dns_creation_failure()
    {
        Http::fake([
            'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
                'success' => false,
            ], 400),
        ]);

        $this->artisan('tunnel:add-subdomain', ['subdomain' => 'testsub'])
            ->expectsOutputToContain('❌ Failed:')
            ->assertExitCode(0);
    }

}