<?php

namespace App\Http\Controllers;

use App\Models\MsHrPelamarType;
use Illuminate\Http\Request;

class MsHrPelamarTypeController extends Controller
{
    public function index()
    {
        $list = MsHrPelamarType::orderBy('ms_hr_pelamar_type_id')->get();
        return view('ms_hr_pelamar_type.index', compact('list'));
    }

    public function create()
    {
        return view('ms_hr_pelamar_type.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ms_hr_pelamar_type_id' => 'required|string|max:50|unique:ms_hr_pelamar_type,ms_hr_pelamar_type_id',
            'type_desc' => 'nullable|string|max:50',
        ]);
        MsHrPelamarType::create($validated);
        return redirect()->route('ms_hr_pelamar_type.index')->with('success', 'Tipe pelamar berhasil ditambah.');
    }

    public function edit($id)
    {
        $item = MsHrPelamarType::findOrFail($id);
        return view('ms_hr_pelamar_type.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MsHrPelamarType::findOrFail($id);
        $validated = $request->validate([
            'type_desc' => 'nullable|string|max:50',
        ]);
        $item->update($validated);
        return redirect()->route('ms_hr_pelamar_type.index')->with('success', 'Tipe pelamar berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = MsHrPelamarType::findOrFail($id);
        $item->delete();
        return redirect()->route('ms_hr_pelamar_type.index')->with('success', 'Tipe pelamar berhasil dihapus.');
    }
}
