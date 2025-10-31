<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tr_hr_pelamar_pengalaman', function (Blueprint $table) {
            $table->id();
            $table->string('tr_hr_pelamar_main_id', 50);
            $table->string('nama_perusahaan', 100);
            $table->string('jabatan', 100);
            $table->string('tahun_masuk', 10)->nullable();
            $table->string('tahun_keluar', 10)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->foreign('tr_hr_pelamar_main_id')
                ->references('tr_hr_pelamar_main_id')
                ->on('tr_hr_pelamar_main')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tr_hr_pelamar_pengalaman');
    }
};
