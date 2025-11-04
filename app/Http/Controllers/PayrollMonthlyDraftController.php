<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPayrollPaymentMonthlyH;

class PayrollMonthlyDraftController extends Controller
{
    public function create()
    {
        return view('payroll.create_monthly_h');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payroll_payment_monthly_h_code' => 'required|string|max:50',
            'periode' => 'required|string|max:20',
            'pay_date' => 'required|date',
        ]);
        $h = new TrPayrollPaymentMonthlyH();
        $h->payroll_payment_monthly_h_code = $validated['payroll_payment_monthly_h_code'];
        $h->periode = $validated['periode'];
        $h->pay_date = $validated['pay_date'];
        $h->save();
        return redirect()->route('payroll')->with('success', 'Draft payroll bulanan berhasil dibuat.');
    }
}
