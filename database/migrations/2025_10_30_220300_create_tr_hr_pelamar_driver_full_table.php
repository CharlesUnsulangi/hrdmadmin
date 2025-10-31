<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_driver', function (Blueprint $table) {
            $table->string('tr_pelamar_driver_id', 50)->primary();
            $table->string('nama', 50)->nullable();
            $table->string('nama_keluarga', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('hp', 50)->nullable();
            $table->string('no_sim', 50)->nullable();
            $table->text('jenis_sim')->nullable();
            $table->tinyInteger('tanggal_lahir')->nullable();
            $table->string('kota_lahir', 50)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('pekerjaan_sebelumnya', 50)->nullable();
            $table->date('kapan_terakhir_bekerja')->nullable();
            $table->text('alasan_keluar')->nullable();
            $table->string('tahu_lamaran_dari', 50)->nullable();
            $table->string('kenal_siapa', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_driver');
    }
};
