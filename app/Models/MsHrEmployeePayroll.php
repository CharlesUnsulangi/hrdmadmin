<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrEmployeePayroll extends Model
{
    protected $table = 'ms_hr_employee_payroll';
    protected $primaryKey = 'id'; // Ganti jika ada primary key lain
    public $incrementing = true;
    protected $fillable = [
        // Tambahkan kolom sesuai struktur tabel
    ];
}
