<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarMain;

class PelamarController extends Controller
{
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
        $validated = $request->validate([
            'email' => 'required|email|max:50',
            'nama' => 'required|string|max:50',
            'email' => 'nullable|email|max:50',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            // 'created_at' => 'nullable|date',
            // 'updated_at' => 'nullable|date',
            'rating' => 'nullable|integer',
            'cek_confirm' => 'nullable|boolean',
            'time_confirm' => 'nullable',
            'cek_cv' => 'nullable|boolean',
            'cek_driver' => 'nullable|boolean',
            'cek_interview' => 'nullable|boolean',
            'cek_kandidat' => 'nullable|boolean',
            'cek_priority' => 'nullable|boolean',
            'cek_tolak' => 'nullable|boolean',
            'cek_wa' => 'nullable|boolean',
            'time_cv' => 'nullable',
            'time_interview' => 'nullable',
            'time_wa' => 'nullable',
            'link_cv' => 'nullable|string',
        ]);
    $validated['tr_hr_pelamar_main_id'] = $validated['email'];
    $validated['date_created'] = now();
    TrHrPelamarMain::create($validated);
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil ditambahkan');
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
