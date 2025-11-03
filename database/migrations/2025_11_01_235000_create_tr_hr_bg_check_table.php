<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_bg_check', function (Blueprint $table) {
            $table->increments('tr_hr_bg_check_id');
            $table->string('tr_hr_pelamar_main_id', 50);
            $table->string('telepon', 50)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('ms_hr_user_id', 50)->nullable();
            $table->string('note', 50)->nullable();
            $table->boolean('cek_fraud')->nullable();
            $table->boolean('cek_bohong')->nullable();
            $table->integer('nilai_positif')->nullable();
            $table->integer('nilai_negatif')->nullable();
            $table->boolean('cek_rekomendasi')->nullable();
            $table->string('jabatan_bg', 50)->nullable();
            $table->string('date_created', 50)->nullable();
            $table->string('user_created', 50)->nullable();
            $table->primary('tr_hr_bg_check_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_bg_check');
    }
};
