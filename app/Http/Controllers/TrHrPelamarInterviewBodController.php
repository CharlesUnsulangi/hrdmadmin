<?php

namespace App\Http\Controllers;

use App\Models\TrHrPelamarInterviewBod;
use App\Models\TrHrPelamarMain;
use Illuminate\Http\Request;

class TrHrPelamarInterviewBodController extends Controller
{
    public function index()
    {
        $interviews = TrHrPelamarInterviewBod::with('pelamar')->paginate(20);
        return view('interview_bod.index', compact('interviews'));
    }

    public function create(Request $request)
    {
        $pelamars = TrHrPelamarMain::all();
        $selectedPelamar = null;
        if ($request->has('pelamar_id')) {
            $selectedPelamar = TrHrPelamarMain::find($request->pelamar_id);
        }
        return view('interview_bod.create', compact('pelamars', 'selectedPelamar'));
    }

    public function store(Request $request)
    {
      $data = $request->validate([
          'ms_hr_user_id' => 'nullable|string|max:50',
              'ms_hr_pelamar_main_id' => 'required|string|max:50',
              'date_interview' => 'required|date',
              'time_start' => 'required',
              // 'time_end' => 'required',
              'rating_final' => 'nullable|integer',
              'cek_offline' => 'nullable|boolean',
              'cek_online' => 'nullable|boolean',
              'red_flag' => 'nullable|integer',
              'green_flag' => 'nullable|integer',
              'note_interview' => 'nullable|string',
        ]);
        TrHrPelamarInterviewBod::create($data);
        return redirect()->route('interview_bod.index')->with('success', 'Interview BOD berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $interview = TrHrPelamarInterviewBod::findOrFail($id);
        $pelamars = TrHrPelamarMain::all();
        return view('interview_bod.edit', compact('interview', 'pelamars'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ms_hr_user_id' => 'nullable|string|max:50',
            'ms_hr_pelamar_main_id' => 'required|string|max:50',
            'date_interview' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'rating_final' => 'nullable|integer',
            'cek_offline' => 'nullable|boolean',
            'cek_online' => 'nullable|boolean',
            'red_flag' => 'nullable|integer',
            'green_flag' => 'nullable|integer',
            'note_interview' => 'nullable|string',
        ]);
        $interview = TrHrPelamarInterviewBod::findOrFail($id);
        $interview->update($data);
        return redirect()->route('interview_bod.index')->with('success', 'Interview BOD berhasil diupdate.');
    }
}
