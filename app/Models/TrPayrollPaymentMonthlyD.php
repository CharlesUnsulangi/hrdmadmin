<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrPayrollPaymentMonthlyD extends Model
{
    protected $table = 'tr_payroll_payment_monthly_d';
    protected $primaryKey = 'id'; // Ganti jika ada primary key lain
    public $incrementing = true;
    protected $fillable = [
        // Tambahkan kolom sesuai struktur tabel
    ];
}
