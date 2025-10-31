<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_pelamar_sosmed', function (Blueprint $table) {
            $table->increments('tr_hr_pelamar_sosmed');
            $table->text('sosmed_link')->nullable();
            $table->string('tr_hr_pelamar_id', 50)->nullable();
            $table->string('sosmed_user', 50)->nullable();
            $table->string('sosmed_type', 50)->nullable();
            $table->date('date_created')->nullable();
            $table->string('user_created', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_pelamar_sosmed');
    }
};
