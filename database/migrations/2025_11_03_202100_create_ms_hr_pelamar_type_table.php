<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ms_hr_pelamar_type', function (Blueprint $table) {
            $table->string('ms_hr_pelamar_type_id', 50)->primary();
            $table->string('type_desc', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_pelamar_type');
    }
};
