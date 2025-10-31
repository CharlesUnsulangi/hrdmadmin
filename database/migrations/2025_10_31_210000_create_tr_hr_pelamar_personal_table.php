<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tr_hr_pelamar_personal', function (Blueprint $table) {
            $table->id();
            $table->string('tr_hr_pelamar_id', 50);
            $table->date('date_lahir')->nullable();
            $table->string('kota_lahir', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('jenis', 20)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->boolean('cek_pengalaman')->default(0);
            $table->timestamps();
            $table->foreign('tr_hr_pelamar_id')
                ->references('tr_hr_pelamar_main_id')
                ->on('tr_hr_pelamar_main')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tr_hr_pelamar_personal');
    }
};
