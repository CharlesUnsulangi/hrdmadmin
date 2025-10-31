<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            // Tambah/ubah kolom sesuai DATABASE_SCHEMA.md
            $table->string('nama', 255)->change();
            $table->string('email', 255)->nullable()->change();
            $table->string('no_hp', 50)->nullable()->change();
            $table->string('status', 50)->nullable()->change();
            $table->integer('rating')->nullable()->change();
            $table->boolean('cek_confirm')->nullable()->change();
            $table->date('time_confirm')->nullable()->change();
            $table->boolean('cek_cv')->nullable()->change();
            $table->boolean('cek_driver')->nullable()->change();
            $table->boolean('cek_interview')->nullable()->change();
            $table->boolean('cek_kandidat')->nullable()->change();
            $table->boolean('cek_priority')->nullable()->change();
            $table->boolean('cek_tolak')->nullable()->change();
            $table->boolean('cek_wa')->nullable()->change();
            $table->date('time_cv')->nullable()->change();
            $table->date('time_interview')->nullable()->change();
            $table->date('time_wa')->nullable()->change();
            $table->string('link_cv', 255)->nullable()->change();
            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'posisi')) {
                $table->string('posisi', 100)->nullable();
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'user_created')) {
                $table->string('user_created', 50)->nullable();
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'date_created')) {
                $table->date('date_created')->nullable();
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'asal_lamaran')) {
                $table->string('asal_lamaran', 100)->nullable();
            }
            if (!Schema::hasColumn('tr_hr_pelamar_main', 'ms_hr_from_id')) {
                $table->string('ms_hr_from_id', 50)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tr_hr_pelamar_main', function (Blueprint $table) {
            // Tidak perlu drop kolom, hanya contoh
        });
    }
};
