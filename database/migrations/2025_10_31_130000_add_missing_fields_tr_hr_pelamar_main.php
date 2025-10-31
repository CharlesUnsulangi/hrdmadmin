<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_confirm')) {
                $table->boolean('cek_confirm')->default(0)->after('rating');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'time_confirm')) {
                $table->dateTime('time_confirm', 7)->nullable()->after('cek_confirm');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_cv')) {
                $table->boolean('cek_cv')->default(0)->after('time_confirm');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_driver')) {
                $table->boolean('cek_driver')->default(0)->after('cek_cv');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_interview')) {
                $table->boolean('cek_interview')->default(0)->after('cek_driver');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_kandidat')) {
                $table->boolean('cek_kandidat')->default(0)->after('cek_interview');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_priority')) {
                $table->boolean('cek_priority')->default(0)->after('cek_kandidat');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_tolak')) {
                $table->boolean('cek_tolak')->default(0)->after('cek_priority');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'cek_wa')) {
                $table->boolean('cek_wa')->default(0)->after('cek_tolak');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'time_cv')) {
                $table->dateTime('time_cv', 7)->nullable()->after('cek_wa');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'time_interview')) {
                $table->dateTime('time_interview', 7)->nullable()->after('time_cv');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'time_wa')) {
                $table->dateTime('time_wa', 7)->nullable()->after('time_interview');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'link_cv')) {
                $table->string('link_cv', 250)->nullable()->after('time_wa');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_confirm')) {
                $table->dropColumn('cek_confirm');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'time_confirm')) {
                $table->dropColumn('time_confirm');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_cv')) {
                $table->dropColumn('cek_cv');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_driver')) {
                $table->dropColumn('cek_driver');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_interview')) {
                $table->dropColumn('cek_interview');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_kandidat')) {
                $table->dropColumn('cek_kandidat');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_priority')) {
                $table->dropColumn('cek_priority');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_tolak')) {
                $table->dropColumn('cek_tolak');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'cek_wa')) {
                $table->dropColumn('cek_wa');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'time_cv')) {
                $table->dropColumn('time_cv');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'time_interview')) {
                $table->dropColumn('time_interview');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'time_wa')) {
                $table->dropColumn('time_wa');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'link_cv')) {
                $table->dropColumn('link_cv');
            }
        });
    }
};
