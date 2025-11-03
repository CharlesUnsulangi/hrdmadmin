<?php

namespace App\Http\Controllers;

use App\Models\TrHrPelamarInterviewSpv;
use App\Models\TrHrPelamarMain;
use Illuminate\Http\Request;

class TrHrPelamarInterviewSpvController extends Controller
{
    public function index()
    {
        $interviews = TrHrPelamarInterviewSpv::with('pelamar')->orderByDesc('date_interview')->paginate(20);
        return view('interview_spv.index', compact('interviews'));
    }

    public function create(Request $request)
    {
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        $selectedPelamar = null;
        if ($request->has('pelamar_id')) {
            $selectedPelamar = TrHrPelamarMain::find($request->pelamar_id);
        }
        return view('interview_spv.create', compact('pelamars', 'selectedPelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            // 'time_end' => 'required',
        ]);
        TrHrPelamarInterviewSpv::create($request->all());

        // Simpan juga ke tabel utama interview
        \App\Models\TrHrPelamarInterviewMain::create([
            'tr_hr_pelamar_main_id' => $request->ms_hr_pelamar_main_id,
            'interview_type' => 'SPV',
            'date_interview' => $request->date_interview,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'rating_spv' => $request->rating_final ?? null,
            'note_spv' => $request->note_interview ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('interview_spv.index')->with('success', 'Data interview supervisor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $interview = TrHrPelamarInterviewSpv::findOrFail($id);
        $pelamars = TrHrPelamarMain::orderBy('nama')->get();
        return view('interview_spv.edit', compact('interview', 'pelamars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ms_hr_pelamar_main_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'date_interview' => 'required|date',
        ]);
        $interview = TrHrPelamarInterviewSpv::findOrFail($id);
        $data = $request->all();
        // If time_start/time_end not filled, use old value
        if (empty($data['time_start'])) {
            $data['time_start'] = $interview->time_start;
        }
        if (empty($data['time_end'])) {
            $data['time_end'] = $interview->time_end;
        }
        $interview->update($data);
        return redirect()->route('interview_spv.index')->with('success', 'Data interview supervisor berhasil diupdate.');
    }

    public function destroy($id)
    {
        $interview = TrHrPelamarInterviewSpv::findOrFail($id);
        $interview->delete();
        return redirect()->route('interview_spv.index')->with('success', 'Data interview supervisor berhasil dihapus.');
    }
}
