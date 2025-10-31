<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_skedul', function (Blueprint $table) {
            $table->string('tr_hr_pelamar_id', 50)->primary();
            $table->dateTime('skedul_pelamar_time')->nullable();
            $table->dateTime('skedul_confirmed')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_skedul');
    }
};
