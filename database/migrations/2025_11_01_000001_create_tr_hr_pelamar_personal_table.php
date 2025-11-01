<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_personal', function (Blueprint $table) {
            $table->string('tr_hr_pelamar_id', 50)->primary();
            $table->string('nama', 50);
            $table->char('nama_keluarga', 10)->nullable();
            $table->date('date_lahir')->nullable();
            $table->string('kota_lahir', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->boolean('cek_pengalaman')->nullable();
            $table->decimal('gaji_diminta', 19, 4)->nullable();
            $table->timestamps();
            $table->foreign('tr_hr_pelamar_id')
                ->references('tr_hr_pelamar_main_id')
                ->on('tr_hr_pelamar_main')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_personal');
    }
};
