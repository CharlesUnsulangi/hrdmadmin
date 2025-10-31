<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_hr_employee_payroll', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50);
            $table->decimal('amount', 19, 2);
            $table->date('pay_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_hr_employee_payroll');
    }
};
