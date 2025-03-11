<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:list-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all tables in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Listing all tables in the database...');

        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");

        if (empty($tables)) {
            $this->warn('No tables found in the database.');
            return 1;
        }

        $headers = ['Table Name'];
        $rows = [];

        foreach ($tables as $table) {
            $rows[] = [$table->table_name];
        }

        $this->table($headers, $rows);
        return 0;
    }
}
