<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_interview', function (Blueprint $table) {
            // Rename column if exists
            if (Schema::hasColumn('tr_hr_pelamar_interview', 'tr_hr_pelamar_id')) {
                $table->renameColumn('tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_interview', function (Blueprint $table) {
            if (Schema::hasColumn('tr_hr_pelamar_interview', 'tr_hr_pelamar_main_id')) {
                $table->renameColumn('tr_hr_pelamar_main_id', 'tr_hr_pelamar_id');
            }
        });
    }
};
