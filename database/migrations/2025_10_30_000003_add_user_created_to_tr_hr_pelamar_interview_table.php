<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_interview', function (Blueprint $table) {
            $table->string('user_created', 100)->nullable()->after('tr_hr_pelamar_id');
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_interview', function (Blueprint $table) {
            $table->dropColumn('user_created');
        });
    }
};
