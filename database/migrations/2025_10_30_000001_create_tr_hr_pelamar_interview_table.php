<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_interview', function (Blueprint $table) {
            $table->increments('tr_hr_pelamar_interview_id');
            $table->string('tr_hr_pelamar_id', 50)->nullable();
            $table->date('date_interview')->nullable();
            $table->time('time_start', 7)->nullable();
            $table->time('time_end', 7)->nullable();
            $table->string('note_operator', 50)->nullable();
            $table->string('note_spv', 50)->nullable();
            $table->string('note_mgr', 50)->nullable();
            $table->string('note_hrd', 50)->nullable();
            $table->string('note_bd', 50)->nullable();
            $table->string('note_gm', 50)->nullable();
            $table->string('note_dir', 50)->nullable();
            $table->string('note_mgt', 50)->nullable();
            $table->integer('rating_operator')->nullable();
            $table->integer('rating_spv')->nullable();
            $table->integer('rating_mgr')->nullable();
            $table->integer('rating_gm')->nullable();
            $table->integer('rating_bd')->nullable();
            $table->integer('rating_mgt')->nullable();
            $table->integer('rating_hrd')->nullable();
            $table->boolean('cek_lanjut')->nullable();
            $table->boolean('cek_tolak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_interview');
    }
};
