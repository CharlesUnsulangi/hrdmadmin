<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarInterviewMain;

class InterviewMainController extends Controller
{
    public function index()
    {
        $list = TrHrPelamarInterviewMain::orderByDesc('date_interview')->paginate(20);
        return view('interview.main_index', compact('list'));
    }

    public function create(Request $request)
    {
        $pelamar_id = $request->get('pelamar_id', '');
        return view('interview.main_form', compact('pelamar_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tr_hr_pelamar_main_id' => 'required|string',
            'interview_type' => 'required|string',
            'date_interview' => 'required|date',
        ]);
        $data = $request->all();
        TrHrPelamarInterviewMain::create($data);
        return redirect()->route('interview_main.index')->with('success', 'Interview berhasil disimpan.');
    }

    public function edit($id)
    {
        $interview = TrHrPelamarInterviewMain::findOrFail($id);
        return view('interview.main_form', compact('interview'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'interview_type' => 'required|string',
            'date_interview' => 'required|date',
        ]);
        $interview = TrHrPelamarInterviewMain::findOrFail($id);
        $interview->update($request->all());
        return redirect()->route('interview_main.index')->with('success', 'Interview berhasil diupdate.');
    }

    public function destroy($id)
    {
        $interview = TrHrPelamarInterviewMain::findOrFail($id);
        $interview->delete();
        return redirect()->route('interview_main.index')->with('success', 'Interview berhasil dihapus.');
    }
}
