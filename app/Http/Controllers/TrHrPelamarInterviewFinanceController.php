<?php

namespace App\Http\Controllers;

use App\Models\TrHrPelamarInterviewFinance;
use App\Models\TrHrPelamarMain;
use Illuminate\Http\Request;

class TrHrPelamarInterviewFinanceController extends Controller
{
    public function index()
    {
        $interviews = TrHrPelamarInterviewFinance::with('pelamar')->orderByDesc('date_interview')->paginate(20);
        return view('interview_finance.index', compact('interviews'));
    }

    public function create(Request $request)
    {
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        $selectedPelamar = null;
        if ($request->has('pelamar_id')) {
            $selectedPelamar = TrHrPelamarMain::find($request->pelamar_id);
        }
        return view('interview_finance.create', compact('pelamars', 'selectedPelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            // 'time_end' => 'required',
        ]);
        TrHrPelamarInterviewFinance::create($request->all());
        return redirect()->route('interview_finance.index')->with('success', 'Data interview finance berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $interview = TrHrPelamarInterviewFinance::findOrFail($id);
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        return view('interview_finance.edit', compact('interview', 'pelamars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);
        $interview = TrHrPelamarInterviewFinance::findOrFail($id);
        $interview->update($request->all());
        return redirect()->route('interview_finance.index')->with('success', 'Data interview finance berhasil diupdate.');
    }

    public function destroy($id)
    {
        $interview = TrHrPelamarInterviewFinance::findOrFail($id);
        $interview->delete();
        return redirect()->route('interview_finance.index')->with('success', 'Data interview finance berhasil dihapus.');
    }
}
