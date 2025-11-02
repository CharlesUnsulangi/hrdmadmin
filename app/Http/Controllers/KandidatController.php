<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsHrKandidat;

class KandidatController extends Controller
{
    public function index()
    {
        $kandidat = \App\Models\MsHrKandidat::orderByDesc('created_at')->paginate(15);
        return view('kandidat.index', compact('kandidat'));
    }

    public function edit($id)
    {
        $kandidat = MsHrKandidat::where('ms_hr_kandidat_emp_id', $id)->firstOrFail();
        return view('kandidat.edit', compact('kandidat'));
    }
}
