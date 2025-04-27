# Laravel Tunnel Manager

[![Latest Version](https://img.shields.io/packagist/v/nassirian/laravel-tunnel-manager.svg?style=flat-square)](https://packagist.org/packages/nassirian/laravel-tunnel-manager)
[![Build Status](https://github.com/nassirian/laravel-tunnel-manager/actions/workflows/run-tests.yml/badge.svg)](https://github.com/nassirian/laravel-tunnel-manager/actions)
[![License](https://img.shields.io/github/license/nassirian/laravel-tunnel-manager.svg?style=flat-square)](https://github.com/nassirian/laravel-tunnel-manager/blob/main/LICENSE)

A Laravel package to manage **Cloudflare Tunnels** and automatically create **subdomains** via Artisan commands.

---

## Features

- ✅ Create new subdomains dynamically
- ✅ Point subdomains to an existing Cloudflare Tunnel
- ✅ Compatible with Laravel 9, 10, 11, and 12
- ✅ Fully tested with PHPUnit
- ✅ Easy installation and usage

---

## Installation

Require the package via Composer:

```bash
composer require nassirian/laravel-tunnel-manager
```

### Publish the configuration file
```bash
php artisan vendor:publish --tag=tunnelmanager-config
```

### Set your .env
```dotenv
TUNNEL_MANAGER_API_TOKEN=your_cloudflare_api_token
TUNNEL_MANAGER_ZONE_ID=your_cloudflare_zone_id
TUNNEL_MANAGER_DOMAIN=yourdomain.com
TUNNEL_MANAGER_TUNNEL_UUID=your_tunnel_uuid
```

### Usage

#### Create a new subdomain
```bash
php artisan tunnel:add-subdomain your-subdomain
```
This will create a DNS CNAME record:
```
your-subdomain.yourdomain.com → your-tunnel-uuid.cfargotunnel.com
```


### Configuration
The configuration file is located at `config/tunnelmanager.php`. You can customize the following options:

- `api_token`: Your Cloudflare API token.
- `zone_id`: Your Cloudflare zone ID.
- `domain`: Your domain name.
- `tunnel_uuid`: The UUID of the tunnel you want to point the subdomain to.


### Testing
The package is fully tested.
To run the tests, use the following command:

```bash
./vendor/bin/phpunit --configuration packages/Nassirian/TunnelManager/phpunit.xml
```

Or if running inside your main Laravel app:
```bash
phpunit
```

### Requirements:
- PHP 8.1 or higher
- Laravel 9, 10, 11, or 12
- Cloudflare account with API token and zone ID


### License
This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
