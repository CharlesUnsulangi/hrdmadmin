<?php

namespace App\Http\Controllers;

use App\Models\MsCompany;
use Illuminate\Http\Request;

class MsCompanyController extends Controller
{
    public function index()
    {
        $companies = MsCompany::all();
        return view('ms_company.index', compact('companies'));
    }

    public function create()
    {
        return view('ms_company.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_code' => 'required|string|max:50|unique:ms_company,company_code',
            'company_desc' => 'nullable|string|max:100',
        ]);
        $validated['rec_usercreated'] = auth()->user()->name ?? 'system';
        $validated['rec_userupdate'] = auth()->user()->name ?? 'system';
        $validated['rec_datecreated'] = now();
        $validated['rec_dateupdate'] = now();
        $validated['rec_status'] = 'A';
        MsCompany::create($validated);
        return redirect()->route('ms-company.index')->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $company = MsCompany::findOrFail($id);
        return view('ms_company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = MsCompany::findOrFail($id);
        $validated = $request->validate([
            'company_desc' => 'nullable|string|max:100',
        ]);
        $validated['rec_userupdate'] = auth()->user()->name ?? 'system';
        $validated['rec_dateupdate'] = now();
        $company->update($validated);
        return redirect()->route('ms-company.index')->with('success', 'Perusahaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $company = MsCompany::findOrFail($id);
        $company->delete();
        return redirect()->route('ms-company.index')->with('success', 'Perusahaan berhasil dihapus');
    }
}
