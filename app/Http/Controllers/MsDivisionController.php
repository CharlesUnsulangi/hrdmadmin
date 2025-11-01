<?php

namespace App\Http\Controllers;

use App\Models\MsDivision;
use Illuminate\Http\Request;

class MsDivisionController extends Controller
{
    public function index()
    {
        $divisions = MsDivision::all();
        return view('ms_division.index', compact('divisions'));
    }

    public function create()
    {
        return view('ms_division.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'div_id' => 'required|string|max:50|unique:ms_division,div_id',
            'div_desc' => 'nullable|string|max:50',
        ]);
        $validated['rec_usercreated'] = auth()->user()->name ?? 'system';
        $validated['rec_userupdate'] = auth()->user()->name ?? 'system';
        $validated['rec_datecreated'] = now();
        $validated['rec_dateupdate'] = now();
        $validated['rec_status'] = 'A';
        MsDivision::create($validated);
        return redirect()->route('ms-division.index')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $division = MsDivision::findOrFail($id);
        return view('ms_division.edit', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $division = MsDivision::findOrFail($id);
        $validated = $request->validate([
            'div_desc' => 'nullable|string|max:50',
        ]);
        $validated['rec_userupdate'] = auth()->user()->name ?? 'system';
        $validated['rec_dateupdate'] = now();
        $division->update($validated);
        return redirect()->route('ms-division.index')->with('success', 'Divisi berhasil diupdate');
    }

    public function destroy($id)
    {
        $division = MsDivision::findOrFail($id);
        $division->delete();
        return redirect()->route('ms-division.index')->with('success', 'Divisi berhasil dihapus');
    }
}
