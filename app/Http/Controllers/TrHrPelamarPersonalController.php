<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TrHrPelamarPersonal;
use Illuminate\Http\Request;

class TrHrPelamarPersonalController extends Controller
{
    public function index()
    {
        $personals = TrHrPelamarPersonal::all();
        return view('tr_hr_pelamar_personal.index', compact('personals'));
    }

    public function create()
    {
        return view('tr_hr_pelamar_personal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tr_hr_pelamar_id' => 'required|string|max:50|unique:tr_hr_pelamar_personal,tr_hr_pelamar_id',
            'nama' => 'required|string|max:50',
            'nama_keluarga' => 'nullable|string|max:10',
            'date_lahir' => 'nullable|date',
            'kota_lahir' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:50',
            'jenis' => 'nullable|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:50',
            'cek_pengalaman' => 'nullable|boolean',
        ]);
        TrHrPelamarPersonal::create($validated);
        return redirect()->route('tr-hr-pelamar-personal.index')->with('success', 'Data personal pelamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $personal = TrHrPelamarPersonal::findOrFail($id);
        return view('tr_hr_pelamar_personal.edit', compact('personal'));
    }

    public function update(Request $request, $id)
    {
        $personal = TrHrPelamarPersonal::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'nama_keluarga' => 'nullable|string|max:10',
            'date_lahir' => 'nullable|date',
            'kota_lahir' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:50',
            'jenis' => 'nullable|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string|max:50',
            'cek_pengalaman' => 'nullable|boolean',
        ]);
        $personal->update($validated);
        return redirect()->route('tr-hr-pelamar-personal.index')->with('success', 'Data personal pelamar berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Optional: implement if needed, or disable for safety
    }
}
