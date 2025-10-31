<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_pengalaman_perusahaan', function (Blueprint $table) {
            $table->increments('tr_hr_pelamar_pengalaman_id');
            $table->string('tr_hr_pelamar_id', 50);
            $table->string('perusahaan', 50);
            $table->date('tgl_start');
            $table->date('tgl_end');
            $table->string('hp_hrd', 50);
            $table->string('nama_hrd', 50);
            $table->string('hp_atasan', 50);
            $table->text('alasan_resign');
            $table->string('jabatan_akhir', 50)->nullable();
            $table->string('jabatan_awal', 50)->nullable();
            $table->decimal('gaji_awal', 19, 2);
            $table->decimal('gaji_akhir', 19, 2);
            $table->integer('sukses_rating')->nullable();
            $table->text('sukses_keterangan')->nullable();
            $table->integer('sulit_rating')->nullable();
            $table->text('sulit_keterangan')->nullable();
            $table->integer('puas_rating')->nullable();
            $table->text('puas_keterangan')->nullable();
            $table->integer('masalah_rating')->nullable();
            $table->text('masalah_keterangan')->nullable();
            $table->text('kesalahan_paling_besar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_pengalaman_perusahaan');
    }
};
