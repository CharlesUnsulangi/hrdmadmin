<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsHrKandidat;

class KandidatController extends Controller
{
    public function index()
    {
        $kandidat = \App\Models\MsHrKandidat::orderByDesc('created_at')->paginate(15);
        return view('kandidat.index', compact('kandidat'));
    }

    public function edit($id)
    {
        $kandidat = MsHrKandidat::where('ms_hr_kandidat_emp_id', $id)->firstOrFail();
        return view('kandidat.edit', compact('kandidat'));
    }
    /**
     * Proses pembuatan PKWTT dari kandidat.
     */
    public function buatPkwtt($id)
    {
        $kandidat = MsHrKandidat::where('ms_hr_kandidat_emp_id', $id)->firstOrFail();

        // Update status kandidat
        $kandidat->ms_status_id = 'pkwtt';
        $kandidat->date_emp = now();
        $kandidat->save();

        // Buat data PKWTT
        $pkwttId = 'PKWTT-' . $kandidat->ms_hr_kandidat_emp_id . '-' . date('YmdHis');
        $start = now()->toDateString();
        $end = now()->addYear()->toDateString();
        $sign = now()->toDateString();

        \App\Models\TrHrPkwtt::create([
            'tr_hd_pkwtt_id' => $pkwttId,
            'ms_emp_id' => $kandidat->ms_hr_kandidat_emp_id, // asumsikan emp_id sama dengan kandidat_id
            'date_pkwtt_start' => $start,
            'date_pkwtt_end' => $end,
            'date_sign' => $sign,
            'ms_user_id' => auth()->user() ? auth()->user()->id : null,
            'ms_company_id' => null,
            'month' => 12
        ]);

        return redirect()->route('kandidat.edit', $id)
            ->with('success', 'PKWTT berhasil dibuat untuk kandidat ini.');
    }
}
