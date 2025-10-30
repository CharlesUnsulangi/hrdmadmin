<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ms_hr_kandidat', function (Blueprint $table) {
            $table->increments('ms_hr_kandidat_id');
            $table->string('nama', 100)->nullable();
            $table->date('date_emp')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_kandidat');
    }
};
