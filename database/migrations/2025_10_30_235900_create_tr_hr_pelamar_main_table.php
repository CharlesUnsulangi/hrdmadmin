<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->string('tr_hr_pelamar_id', 50)->primary();
            $table->string('nama', 255);
            $table->string('email', 255);
            $table->string('hp', 50)->nullable();
            $table->string('posisi', 100)->nullable();
            $table->string('user_created', 50)->nullable();
            $table->date('date_created')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('cek_confirm')->nullable();
            $table->date('time_confirm')->nullable();
            $table->boolean('cek_cv')->nullable();
            $table->boolean('cek_driver')->nullable();
            $table->boolean('cek_interview')->nullable();
            $table->boolean('cek_kandidat')->nullable();
            $table->boolean('cek_priority')->nullable();
            $table->boolean('cek_tolak')->nullable();
            $table->boolean('cek_wa')->nullable();
            $table->date('time_cv')->nullable();
            $table->date('time_interview')->nullable();
            $table->date('time_wa')->nullable();
            $table->string('link_cv', 255)->nullable();
            $table->string('asal_lamaran', 100)->nullable();
            $table->string('ms_hr_from_id', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_main');
    }
};
