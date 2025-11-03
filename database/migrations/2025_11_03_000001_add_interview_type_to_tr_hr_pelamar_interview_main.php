<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_interview_main', function (Blueprint $table) {
            $table->string('interview_type', 32)->nullable()->after('tr_hr_pelamar_main_id');
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_interview_main', function (Blueprint $table) {
            $table->dropColumn('interview_type');
        });
    }
};
