<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPayrollPaymentMonthlyD;
use App\Models\MsEmployee;

class PayrollMonthlyDetailController extends Controller
{
    public function show($code_h)
    {
        $details = TrPayrollPaymentMonthlyD::query()
            ->where('payroll_payment_monthly_h', $code_h)
            ->leftJoin('ms_employee', 'tr_payroll_payment_monthly_d.payroll_payment_emp_code', '=', 'ms_employee.emp_id')
            ->select('tr_payroll_payment_monthly_d.*', 'ms_employee.emp_name as nama')
            ->get();
        return view('payroll.detail_monthly', compact('details', 'code_h'));
    }
}
