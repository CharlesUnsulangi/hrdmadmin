<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarMain;

class PelamarController extends Controller
{
    public function checkId(Request $request)
    {
        $emails = $request->input('emails', []);
        $exists = [];
        if (!empty($emails)) {
            $exists = TrHrPelamarMain::whereIn('tr_hr_pelamar_main_id', $emails)->pluck('tr_hr_pelamar_main_id')->toArray();
        }
        return response()->json(['exists' => $exists]);
    }
    public function index()
    {
        $pelamars = TrHrPelamarMain::all();
        return view('pelamar.index', compact('pelamars'));
    }

    public function create()
    {
        return view('pelamar.create');
    }

    public function store(Request $request)
    {
        $rows = $request->input('rows', []);
        $success = 0;
        foreach ($rows as $row) {
            $validated = validator($row, [
                'nama' => 'required|string|max:50',
                'email' => 'required|email|max:50',
                'no_hp' => 'required|string|max:50',
                'ms_hr_from_id' => 'nullable|string|max:50',
                'rating' => 'nullable|integer|min:0|max:5',
                'status' => 'nullable|string|max:50',
            ])->validate();
            $validated['tr_hr_pelamar_main_id'] = $validated['email'];
            $validated['date_created'] = now();
            $validated['cek_shortlist'] = true;
            $validated['cek_staff'] = true;
            $validated['cek_driver'] = false;
            $validated['cek_helper'] = false;
            TrHrPelamarMain::create($validated);
            $success++;
        }
        return redirect()->route('pelamar.index')->with('success', $success.' pelamar berhasil ditambahkan');
    }

    public function edit($id)
    {
    $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        return view('pelamar.edit', compact('pelamar'));
    }

    public function update(Request $request, $id)
    {
        $pelamar = TrHrPelamarMain::findOrFail($id);
        $validated = $request->validate([
            'tr_hr_pelamar_id' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tr_hr_pelamar_main,email,' . $id . ',tr_hr_pelamar_id',
            'hp' => 'nullable|string|max:50',
            'posisi' => 'nullable|string|max:100',
            'user_created' => 'nullable|string|max:50',
            // 'date_created' => 'nullable|date', // Dihapus, tidak perlu validasi/update
            'rating' => 'nullable|integer|min:1|max:5',
            'cek_confirm' => 'nullable|boolean',
            'time_confirm' => 'nullable|date',
            'cek_cv' => 'nullable|boolean',
            'cek_driver' => 'nullable|boolean',
            'cek_interview' => 'nullable|boolean',
            'cek_kandidat' => 'nullable|boolean',
            'cek_priority' => 'nullable|boolean',
            'cek_tolak' => 'nullable|boolean',
            'cek_wa' => 'nullable|boolean',
            'time_cv' => 'nullable|date',
            'time_interview' => 'nullable|date',
            'time_wa' => 'nullable|date',
            'link_cv' => 'nullable|string|max:255',
            'asal_lamaran' => 'nullable|string|max:100',
            'ms_hr_from_id' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
        ]);
        $pelamar->update($validated);
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil diupdate');
    }

    public function destroy($id)
    {
    $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        $pelamar->delete();
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil dihapus');
    }
}
