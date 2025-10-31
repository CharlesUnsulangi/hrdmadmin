<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_payroll_payment_monthly_h', function (Blueprint $table) {
            $table->id();
            $table->string('periode', 20);
            $table->date('pay_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_payroll_payment_monthly_h');
    }
};
