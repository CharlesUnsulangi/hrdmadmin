<?php

namespace App\Http\Controllers;

use App\Models\TrHrPelamarInterviewHrd;
use App\Models\TrHrPelamarMain;
use Illuminate\Http\Request;

class TrHrPelamarInterviewHrdController extends Controller
{
    public function index()
    {
        $interviews = TrHrPelamarInterviewHrd::with('pelamar')->orderByDesc('date_interview')->paginate(20);
        return view('interview_hrd.index', compact('interviews'));
    }

    public function create(Request $request)
    {
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        $selectedPelamar = null;
        if ($request->has('pelamar_id')) {
            $selectedPelamar = TrHrPelamarMain::find($request->pelamar_id);
        }
        return view('interview_hrd.create', compact('pelamars', 'selectedPelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            // 'time_end' => 'required',
        ]);
        TrHrPelamarInterviewHrd::create($request->all());
        return redirect()->route('interview_hrd.index')->with('success', 'Data interview HRD berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $interview = TrHrPelamarInterviewHrd::findOrFail($id);
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        return view('interview_hrd.edit', compact('interview', 'pelamars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);
        $interview = TrHrPelamarInterviewHrd::findOrFail($id);
        $interview->update($request->all());
        return redirect()->route('interview_hrd.index')->with('success', 'Data interview HRD berhasil diupdate.');
    }

    public function destroy($id)
    {
        $interview = TrHrPelamarInterviewHrd::findOrFail($id);
        $interview->delete();
        return redirect()->route('interview_hrd.index')->with('success', 'Data interview HRD berhasil dihapus.');
    }
}
