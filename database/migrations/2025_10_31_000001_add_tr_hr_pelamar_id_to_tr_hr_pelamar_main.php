<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->string('tr_hr_pelamar_id', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->dropColumn('tr_hr_pelamar_id');
        });
    }
};
