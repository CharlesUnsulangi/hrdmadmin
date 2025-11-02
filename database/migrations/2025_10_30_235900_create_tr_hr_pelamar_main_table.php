<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->string('tr_hr_pelamar_main_id', 50)->primary();
            $table->string('nama', 50);
            $table->string('email', 50)->nullable();
            $table->string('no_hp', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('cek_confirm')->nullable();
            $table->time('time_confirm', 7)->nullable();
            $table->boolean('cek_cv')->nullable();
            $table->boolean('cek_driver')->nullable();
            $table->boolean('cek_interview')->nullable();
            $table->boolean('cek_kandidat')->nullable();
            $table->boolean('cek_priority')->nullable();
            $table->boolean('cek_tolak')->nullable();
            $table->boolean('cek_wa')->nullable();
            $table->time('time_cv', 7)->nullable();
            $table->time('time_interview', 7)->nullable();
            $table->time('time_wa', 7)->nullable();
            $table->text('link_cv')->nullable();
            $table->dateTime('date_created');
            $table->boolean('cek_shortlist')->nullable();
            $table->boolean('cek_helper')->nullable();
            $table->boolean('cek_staff')->nullable();
            $table->string('google_event_id', 255)->nullable(); // Untuk simpan event Google Calendar
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_main');
    }
};
