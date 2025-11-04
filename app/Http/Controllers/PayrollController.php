<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPayrollPaymentMonthlyH;

class PayrollController extends Controller
{
    public function index()
    {
        $sortable = ['periode', 'payroll_monthly_date_payment'];
        $sort = request('sort');
        $order = request('order', 'desc');
        $query = TrPayrollPaymentMonthlyH::query();
        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $order);
        }
        $payrolls = $query->get();
        return view('payroll.index', compact('payrolls'));
    }

    public function createDraft()
    {
        return view('payroll.draft');
    }

    public function storeDraft(Request $request)
    {
        $rows = $request->input('rows', []);
        if (empty($rows)) {
            return back()->with('error', 'Data payroll detail tidak boleh kosong.');
        }
        foreach ($rows as $row) {
            $detail = new \App\Models\TrPayrollPaymentMonthlyDDraft();
            $detail->payroll_payment_emp_code = $row['nama_employee'] ?? null;
            $detail->payroll_payment_rekno = $row['rekening'] ?? null;
            $detail->tunjangan = $row['tunjangan'] ?? null;
            $detail->komisi = $row['komisi'] ?? null;
            $detail->bonus = $row['bonus'] ?? null;
            $detail->thr = $row['thr'] ?? null;
            $detail->bpjs = $row['bpjs'] ?? null;
            $detail->potongan = $row['potongan'] ?? null;
            $detail->cicilan = $row['cicilan'] ?? null;
            $detail->payroll_payment_total_payment = $row['total'] ?? null;
            $detail->absen = $row['absen'] ?? null;
            $detail->last_absen = $row['terakhir_absen'] ?? null;
            $detail->email = $row['email'] ?? null;
            $detail->payroll_payment_value = $row['total_value'] ?? null;
            // Set kolom wajib dummy/otomatis (rec_comcode, rec_areacode, payroll_payment_monthly_h, payroll_payment_monthly_no, payroll_payment_payrollmonthlycode)
            $detail->rec_comcode = 'COM';
            $detail->rec_areacode = 'AREA';
            $detail->payroll_payment_monthly_h = 'DRAFT';
            $detail->payroll_payment_monthly_no = rand(1000,9999);
            $detail->payroll_payment_payrollmonthlycode = 'DRAFT';
            $detail->save();
        }
        return redirect()->route('payroll')->with('success', 'Draft payroll detail berhasil disimpan.');
    }
}
