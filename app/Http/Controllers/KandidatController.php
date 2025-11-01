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
}
