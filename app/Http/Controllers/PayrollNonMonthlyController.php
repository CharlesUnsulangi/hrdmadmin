<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPayrollPaymentNonMonthlyD;

class PayrollNonMonthlyController extends Controller
{
    public function edit($code_h)
    {
        $header = TrPayrollPaymentNonMonthlyD::where('payrollpaymentnonmonthly_code_h', $code_h)->first();
        $details = TrPayrollPaymentNonMonthlyD::where('payrollpaymentnonmonthly_code_h', $code_h)->get();
        return view('payroll.edit_nonmonthly', compact('header', 'details'));
    }

    public function update(Request $request, $code_h)
    {
        $details = $request->input('details', []);
        foreach ($details as $code_d => $data) {
            $detail = TrPayrollPaymentNonMonthlyD::where('payrollpaymentnonmonthly_code_d', $code_d)->where('payrollpaymentnonmonthly_code_h', $code_h)->first();
            if ($detail) {
                $detail->payrollpaymentnonmonthly_total_payment = $data['total'];
                $detail->payrollpaymentnonmonthly_date_payroll_payment = $data['date'];
                $detail->payrollpaymentnonmonthly_note = $data['note'];
                $detail->save();
            }
        }
        return redirect()->route('payroll')->with('success', 'Payroll non bulanan berhasil diupdate.');
    }
}
