<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_skedul', function (Blueprint $table) {
            $table->increments('tr_hr_pelamar_skedul_id');
            $table->string('tr_hr_pelamar_id', 50);
            $table->dateTime('skedul_pelamar_time')->nullable();
            $table->dateTime('skedul_confirmed')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->primary('tr_hr_pelamar_skedul_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_skedul');
    }
};
