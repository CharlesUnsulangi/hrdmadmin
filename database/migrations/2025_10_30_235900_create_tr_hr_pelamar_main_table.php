<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_main', function (Blueprint $table) {
            $table->id('tr_hr_pelamar_main_id');
            $table->string('nama', 100);
            $table->string('email', 100)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('status', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_main');
    }
};
