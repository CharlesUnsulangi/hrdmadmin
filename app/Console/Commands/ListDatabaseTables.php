<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListDatabaseTables extends Command
{
    protected $signature = 'db:list-tables';
    protected $description = 'List all tables in the connected database';

    public function handle()
    {
        $tables = DB::select('SELECT name FROM sys.tables');
        $this->info('Tables in database:');
        foreach ($tables as $table) {
            $this->line($table->name);
        }
    }
}
