<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPkwtt;

class PkwttController extends Controller
{
    public function index()
    {
        $list = TrHrPkwtt::orderByDesc('date_pkwtt_start')->get();
        return view('pkwtt.index', compact('list'));
    }

    public function create(Request $request)
    {
        $ms_emp_id = $request->get('ms_emp_id', '');
        return view('pkwtt.create', compact('ms_emp_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ms_emp_id' => 'required|string|max:50',
            'date_pkwtt_start' => 'required|date',
            'date_pkwtt_end' => 'required|date|after:date_pkwtt_start',
            'date_sign' => 'required|date',
            'month' => 'required|integer|min:1',
        ]);

        $pkwttId = 'PKWTT-' . $validated['ms_emp_id'] . '-' . date('YmdHis');

        TrHrPkwtt::create([
            'tr_hd_pkwtt_id' => $pkwttId,
            'ms_emp_id' => $validated['ms_emp_id'],
            'date_pkwtt_start' => $validated['date_pkwtt_start'],
            'date_pkwtt_end' => $validated['date_pkwtt_end'],
            'date_sign' => $validated['date_sign'],
            'ms_user_id' => auth()->user() ? auth()->user()->id : null,
            'ms_company_id' => null,
            'month' => $validated['month'],
        ]);

        return redirect()->route('pkwtt.index')->with('success', 'PKWTT berhasil dibuat.');
    }
}
