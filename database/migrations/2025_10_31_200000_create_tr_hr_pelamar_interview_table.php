<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tr_hr_pelamar_interview', function (Blueprint $table) {
            $table->id();
            $table->string('tr_hr_pelamar_main_id', 50);
            $table->date('tanggal');
            $table->string('interviewer', 100);
            $table->integer('score')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();

            $table->foreign('tr_hr_pelamar_main_id')
                ->references('tr_hr_pelamar_main_id')
                ->on('tr_hr_pelamar_main')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tr_hr_pelamar_interview');
    }
};
