<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->string('ms_hr_from_id')->nullable()->after('asal_lamaran');
            // Optionally, you can add a foreign key constraint if needed:
            // $table->foreign('ms_hr_from_id')->references('ms_hr_from_id')->on('ms_hr_from');
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->dropColumn('ms_hr_from_id');
        });
    }
};
