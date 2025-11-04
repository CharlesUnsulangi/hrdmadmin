<?php
namespace App\Http\Controllers;

use App\Models\TrHrPelamarInterview;
use Illuminate\Http\Request;

class TrHrPelamarInterviewController extends Controller
{
    public function index()
    {
        $interviews = TrHrPelamarInterview::paginate(50);
        return view('tr_hr_pelamar_interview.index', compact('interviews'));
    }

    public function show($id)
    {
        $interview = TrHrPelamarInterview::findOrFail($id);
        return view('tr_hr_pelamar_interview.show', compact('interview'));
    }
}
