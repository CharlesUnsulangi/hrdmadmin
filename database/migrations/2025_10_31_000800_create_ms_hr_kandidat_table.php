<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_hr_kandidat', function (Blueprint $table) {
            $table->string('ms_hr_kandidat_emp_id', 50)->primary();
            $table->string('ms_status_id', 50)->nullable();
            $table->string('ms_hr_user_id', 50)->nullable();
            $table->date('date_kandidat')->nullable();
            $table->date('date_emp')->nullable();
            $table->date('date_hrd_approve')->nullable();
            $table->date('date_finance_approve')->nullable();
            $table->date('date_bod_approve')->nullable();
            $table->integer('rating_hrd')->nullable();
            $table->integer('rating_finance')->nullable();
            $table->integer('rating_bod')->nullable();
            $table->integer('rating_spv')->nullable();
            $table->date('date_spv')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_kandidat');
    }
};
