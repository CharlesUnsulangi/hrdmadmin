<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPayrollPaymentMonthlyDDraft;

class PayrollDraftDetailController extends Controller
{
    public function index()
    {
        $drafts = TrPayrollPaymentMonthlyDDraft::all();
        return view('payroll.draft_detail', compact('drafts'));
    }
    public function create()
    {
        return view('payroll.draft_detail_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rec_comcode' => 'required|string|max:50',
            'rec_areacode' => 'required|string|max:50',
            'payroll_payment_monthly_h' => 'required|string|max:50',
            'payroll_payment_monthly_no' => 'required|integer',
            'payroll_payment_payrollmonthlycode' => 'required|string|max:50',
            'payroll_payment_date_payroll_payment' => 'nullable|date',
            'payroll_payment_emp_code' => 'nullable|string|max:50',
            'payroll_payment_total_payment' => 'nullable|numeric',
            'payroll_payment_user_payroll' => 'nullable|string|max:50',
            'payroll_payment_note' => 'nullable|string|max:50',
            'payroll_payment_transmaincoacode' => 'nullable|string|max:50',
            'payroll_payment_potongan' => 'nullable|numeric',
            'payroll_payment_value' => 'nullable|numeric',
            'payroll_payment_rekno' => 'nullable|string|max:50',
            'upah_pokok' => 'nullable|numeric',
            'tunjangan' => 'nullable|numeric',
            'komisi' => 'nullable|numeric',
            'bonus' => 'nullable|numeric',
            'thr' => 'nullable|numeric',
            'pajak' => 'nullable|numeric',
            'bpjs' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'cicilan' => 'nullable|numeric',
            'absen' => 'nullable|integer',
            'lainnya' => 'nullable|numeric',
            'last_absen' => 'nullable|date',
            'email' => 'nullable|string|max:50',
        ]);
        TrPayrollPaymentMonthlyDDraft::create($validated);
        return redirect()->route('payroll.draft.detail.create')->with('success', 'Draft payroll detail berhasil ditambahkan.');
    }
}
