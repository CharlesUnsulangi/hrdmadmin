<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrPayrollPaymentMonthlyDDraft extends Model
{
    protected $table = 'tr_payroll_payment_monthly_d_draft';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;
    protected $fillable = [
        'rec_comcode',
        'rec_areacode',
        'payroll_payment_monthly_h',
        'payroll_payment_monthly_no',
        'payroll_payment_payrollmonthlycode',
        'payroll_payment_date_payroll_payment',
        'payroll_payment_emp_code',
        'payroll_payment_total_payment',
        'payroll_payment_user_payroll',
        'payroll_payment_note',
        'payroll_payment_transmaincoacode',
        'payroll_payment_potongan',
        'payroll_payment_value',
        'payroll_payment_rekno',
        'upah_pokok',
        'tunjangan',
        'komisi',
        'bonus',
        'thr',
        'pajak',
        'bpjs',
        'potongan',
        'cicilan',
        'absen',
        'lainnya',
        'last_absen',
        'email',
    ];
}
