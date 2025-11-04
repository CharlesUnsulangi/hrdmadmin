<?php

namespace App\Http\Controllers;

use App\Models\TrHrPelamarSkedul;
use App\Models\TrHrPelamarMain;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data interview, join ke pelamar
        $query = TrHrPelamarSkedul::query()->with('pelamar');
        // Filter (opsional)
        if ($request->filled('search')) {
            $query->whereHas('pelamar', function($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%');
            });
        }
        $interviews = $query->orderByDesc('skedul_pelamar_time')->paginate(20);
        return view('interview.index', compact('interviews'));
    }

    public function create()
    {
    // Ambil semua pelamar yang belum dijadwalkan interview (atau semua pelamar)
    $pelamars = TrHrPelamarMain::orderBy('nama')->get();
    $selectedPelamarId = request('tr_hr_pelamar_id');
    return view('interview.create', compact('pelamars', 'selectedPelamarId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tr_hr_pelamar_id' => 'required|exists:tr_hr_pelamar_main,tr_hr_pelamar_main_id',
            'skedul_pelamar_date' => 'required|date',
            'skedul_pelamar_time' => ['required', 'regex:/^([01]?\d|2[0-3]):[0-5]\d$/'],
        ]);

        // Gabungkan tanggal dan jam menjadi satu datetime
        $datetimeString = $request->skedul_pelamar_date . ' ' . $request->skedul_pelamar_time;
        $skedulTime = Carbon::createFromFormat('Y-m-d H:i', $datetimeString)->format('Y-m-d H:i:s');
        $now = Carbon::now()->format('Y-m-d H:i:s');

        TrHrPelamarSkedul::create([
            'tr_hr_pelamar_id' => $request->tr_hr_pelamar_id,
            'skedul_pelamar_time' => $skedulTime,
            'created_at' => $now,
            'updated_at' => $now,
            'ms_hr_user_id' => auth()->user() ? auth()->user()->id : null,
        ]);

        return redirect()->route('interview')->with('success', 'Jadwal interview berhasil ditambahkan.');
    }
}
