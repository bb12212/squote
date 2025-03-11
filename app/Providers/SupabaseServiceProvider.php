<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class SupabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('supabase', function ($app) {
            $config = $app['config']['supabase'];
            
            return new Client([
                'base_uri' => $config['url'],
                'headers' => [
                    'apikey' => $config['key'],
                    'Authorization' => 'Bearer ' . $config['key'],
                    'Content-Type' => 'application/json',
                ],
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
} 