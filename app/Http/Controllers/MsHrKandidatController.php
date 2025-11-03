<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\MsHrKandidat;
use Illuminate\Http\Request;

class MsHrKandidatController extends Controller
{
    public function index()
    {
        $kandidats = MsHrKandidat::all();
        return view('ms_hr_kandidat.index', compact('kandidats'));
    }

    public function create()
    {
        return view('ms_hr_kandidat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ms_hr_kandidat_emp_id' => 'required|string|max:50|unique:ms_hr_kandidat,ms_hr_kandidat_emp_id',
            'ms_status_id' => 'nullable|string|max:50',
            'ms_hr_user_id' => 'nullable|string|max:50',
            'date_kandidat' => 'nullable|date',
            'date_emp' => 'nullable|date',
            'date_hrd_approve' => 'nullable|date',
            'date_finance_approve' => 'nullable|date',
            'date_bod_approve' => 'nullable|date',
            'rating_hrd' => 'nullable|integer',
            'rating_finance' => 'nullable|integer',
            'rating_bod' => 'nullable|integer',
            'rating_spv' => 'nullable|integer',
            'date_spv' => 'nullable|date',
        ]);
        MsHrKandidat::create($validated);
        return redirect()->route('ms-hr-kandidat.index')->with('success', 'Data kandidat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kandidat = MsHrKandidat::findOrFail($id);
        return view('ms_hr_kandidat.edit', compact('kandidat'));
    }

    public function update(Request $request, $id)
    {
        $kandidat = MsHrKandidat::findOrFail($id);
        $validated = $request->validate([
            'ms_status_id' => 'nullable|string|max:50',
            'ms_hr_user_id' => 'nullable|string|max:50',
            'date_kandidat' => 'nullable|date',
            'date_emp' => 'nullable|date',
            'date_hrd_approve' => 'nullable|date',
            'date_finance_approve' => 'nullable|date',
            'date_bod_approve' => 'nullable|date',
            'rating_hrd' => 'nullable|integer',
            'rating_finance' => 'nullable|integer',
            'rating_bod' => 'nullable|integer',
            'rating_spv' => 'nullable|integer',
            'date_spv' => 'nullable|date',
        ]);
        $kandidat->update($validated);
        return redirect()->route('ms-hr-kandidat.index')->with('success', 'Data kandidat berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Optional: implement if needed, or disable for safety
    }
}
