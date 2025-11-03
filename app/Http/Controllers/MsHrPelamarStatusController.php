<?php

namespace App\Http\Controllers;

use App\Models\MsHrPelamarStatus;
use Illuminate\Http\Request;

class MsHrPelamarStatusController extends Controller
{
    public function index()
    {
        $statuses = MsHrPelamarStatus::all();
        return view('ms_hr_pelamar_status.index', compact('statuses'));
    }

    public function create()
    {
        return view('ms_hr_pelamar_status.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ms_hr_pelamar_status_id' => 'required|string|max:50|unique:ms_hr_pelamar_status,ms_hr_pelamar_status_id',
            'status_desc' => 'nullable|string|max:50',
        ]);
        MsHrPelamarStatus::create($validated);
        return redirect()->route('ms_hr_pelamar_status.index')->with('success', 'Status pelamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $status = MsHrPelamarStatus::findOrFail($id);
        return view('ms_hr_pelamar_status.edit', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = MsHrPelamarStatus::findOrFail($id);
        $validated = $request->validate([
            'status_desc' => 'nullable|string|max:50',
        ]);
        $status->update($validated);
        return redirect()->route('ms_hr_pelamar_status.index')->with('success', 'Status pelamar berhasil diupdate');
    }

    public function destroy($id)
    {
        $status = MsHrPelamarStatus::findOrFail($id);
        $status->delete();
        return redirect()->route('ms_hr_pelamar_status.index')->with('success', 'Status pelamar berhasil dihapus');
    }
}
