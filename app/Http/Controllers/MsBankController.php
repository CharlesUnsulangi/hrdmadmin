<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\MsBank;
use Illuminate\Http\Request;

class MsBankController extends Controller
{
    public function index()
    {
        $banks = MsBank::all();
        return view('ms_bank.index', compact('banks'));
    }

    public function create()
    {
        return view('ms_bank.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Bank_Code' => 'required|string|max:100|unique:ms_bank,Bank_Code',
            'rec_usercreated' => 'required|string|max:50',
            'rec_userupdate' => 'required|string|max:50',
            'rec_datecreated' => 'required|date',
            'rec_dateupdate' => 'required|date',
            'rec_status' => 'required|string|max:1',
        ]);
        MsBank::create($validated);
        return redirect()->route('ms-bank.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    public function edit($Bank_Code)
    {
        $bank = MsBank::findOrFail($Bank_Code);
        return view('ms_bank.edit', compact('bank'));
    }

    public function update(Request $request, $Bank_Code)
    {
        $bank = MsBank::findOrFail($Bank_Code);
        $validated = $request->validate([
            'rec_usercreated' => 'required|string|max:50',
            'rec_userupdate' => 'required|string|max:50',
            'rec_datecreated' => 'required|date',
            'rec_dateupdate' => 'required|date',
            'rec_status' => 'required|string|max:1',
        ]);
        $bank->update($validated);
        return redirect()->route('ms-bank.index')->with('success', 'Bank berhasil diupdate.');
    }

    public function destroy($Bank_Code)
    {
        $bank = MsBank::findOrFail($Bank_Code);
        $bank->delete();
        return redirect()->route('ms-bank.index')->with('success', 'Bank berhasil dihapus.');
    }
}
