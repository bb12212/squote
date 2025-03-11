<?php

namespace App\Console\Commands;

use App\Facades\Supabase;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestSupabaseConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supabase:test-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the connection to Supabase';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Supabase connection...');

        // Test database connection
        try {
            $this->info('Testing database connection...');
            $pdo = DB::connection()->getPdo();
            $this->info('Database connection successful!');
            $this->info('Connected to database: ' . DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            $this->error('Database connection failed!');
            $this->error($e->getMessage());
            return 1;
        }

        // Test Supabase API connection
        try {
            $this->info('Testing Supabase API connection...');
            
            if (!app()->bound('supabase')) {
                $this->warn('Supabase service is not bound in the container.');
                $this->info('Make sure you have registered the SupabaseServiceProvider.');
                return 1;
            }
            
            $supabase = app('supabase');
            $this->info('Supabase API connection successful!');
        } catch (\Exception $e) {
            $this->error('Supabase API connection failed!');
            $this->error($e->getMessage());
            return 1;
        }

        $this->info('All connections successful!');
        return 0;
    }
}
