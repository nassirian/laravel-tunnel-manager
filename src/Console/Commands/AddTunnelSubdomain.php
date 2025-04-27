<?php
namespace Nassirian\TunnelManager\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
class AddTunnelSubdomain extends Command
{
    protected $signature = 'tunnel:add-subdomain {subdomain}';
    protected $description = 'Add a new subdomain to Cloudflare Tunnel';


    public function handle()
    {
        $subdomain = $this->argument('subdomain');
        $zoneId = config('tunnelmanager.zone_id');
        $apiToken = config('tunnelmanager.api_token');
        $domain = config('tunnelmanager.domain');
        $tunnelUuid = config('tunnelmanager.tunnel_uuid');

        $response = Http::withToken($apiToken)->post("https://api.cloudflare.com/client/v4/zones/{$zoneId}/dns_records", [
            'type' => 'CNAME',
            'name' => "{$subdomain}.{$domain}",
            'content' => "{$tunnelUuid}.cfargotunnel.com",
            'proxied' => true,
            'ttl' => 120,
        ]);

        if ($response->successful()) {
            $this->info("✅ Subdomain {$subdomain}.{$domain} created successfully!");
        } else {
            $this->error("❌ Failed: " . $response->body());
        }
    }
}