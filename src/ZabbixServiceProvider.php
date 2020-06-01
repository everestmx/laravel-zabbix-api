<?php

namespace Everestmx\Zabbix;

use Illuminate\Support\ServiceProvider;

/**
 * Class ZabbixServiceProvider
 * @package Everestmx\Zabbix
 */
class ZabbixServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/zabbix.php' => config_path('zabbix.php'),
        ], 'zabbix');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('zabbix', function ($app) {
            return new ZabbixApi(
                config('zabbix.url'),
                config('zabbix.username'),
                config('zabbix.password'),
                config('zabbix.http_username'),
                config('zabbix.http_password'),
                config('zabbix.authToken'),
                config('zabbix.sslContext'),
                config('zabbix.checkSsl'),
            );
        });
    }
}
