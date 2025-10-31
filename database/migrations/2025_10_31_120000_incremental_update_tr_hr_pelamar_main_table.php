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
            // Tambahkan kolom yang belum ada sesuai AI_SAFETY_GUIDELINES.md
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'asal_lamaran')) {
                $table->string('asal_lamaran', 50)->nullable()->after('tr_hr_pelamar_id');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'ms_hr_from_id')) {
                $table->string('ms_hr_from_id', 50)->nullable()->after('asal_lamaran');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'rating')) {
                $table->integer('rating')->nullable()->after('ms_hr_from_id');
            }
            // Tambahkan kolom lain sesuai kebutuhan dari AI_SAFETY_GUIDELINES.md
            // Contoh tambahan kolom:
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'created_by')) {
                $table->string('created_by', 50)->nullable()->after('rating');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'updated_by')) {
                $table->string('updated_by', 50)->nullable()->after('created_by');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('updated_by');
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
            // Tambahkan kolom lain sesuai kebutuhan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan jika ada
            if (Schema::hasColumn('tr_hr_pelamar_main', 'asal_lamaran')) {
                $table->dropColumn('asal_lamaran');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'ms_hr_from_id')) {
                $table->dropColumn('ms_hr_from_id');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'created_by')) {
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'updated_by')) {
                $table->dropColumn('updated_by');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('tr_hr_pelamar_main', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            // Hapus kolom lain jika perlu
        });
    }
};
