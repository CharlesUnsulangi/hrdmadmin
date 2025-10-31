<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_hr_wa_msg_id', function (Blueprint $table) {
            $table->increments('tr_hr_wa_msg_id');
            $table->string('email', 50)->nullable();
            $table->string('ms_hr_pelamar_id', 50)->nullable();
            $table->string('hp', 50)->nullable();
            $table->text('link')->nullable();
            $table->text('msg')->nullable();
            $table->integer('ms_hr_wa_msg_id')->nullable();
            $table->time('time_sent', 7)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_hr_wa_msg_id');
    }
};
