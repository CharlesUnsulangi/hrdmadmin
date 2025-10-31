<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_hr_wa_msg', function (Blueprint $table) {
            $table->id();
            $table->string('msg_code', 50)->nullable();
            $table->string('msg_text', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_wa_msg');
    }
};
