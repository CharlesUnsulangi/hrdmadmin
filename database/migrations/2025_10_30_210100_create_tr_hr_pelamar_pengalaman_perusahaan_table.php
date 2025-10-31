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
            $table->string('nama_perusahaan', 100)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('alasan_keluar', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_pengalaman_perusahaan');
    }
};
