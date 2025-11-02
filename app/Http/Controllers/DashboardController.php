<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik pelamar (dummy, ganti dengan query sesuai tabel pelamar)
        $totalApplicants = DB::table('tr_hr_pelamar_interview_main')->count();
        $confirmedApplicants = DB::table('tr_hr_pelamar_interview_main')->whereNotNull('date_interview')->count();
        $todayInterviews = DB::table('tr_hr_pelamar_interview_main')->whereDate('date_interview', now()->toDateString())->count();
        $newEmployees = DB::table('ms_hr_kandidat')->whereNotNull('date_emp')->count();
        // Statistik per user HRD (leaderboard)
        $userStats = DB::table('tr_hr_pelamar_interview_main')
            ->select('user_created', DB::raw('count(*) as total'))
            ->groupBy('user_created')
            ->orderByDesc('total')
            ->get();

        // Daftar interview terdekat (dummy, ganti dengan relasi pelamar)
        $upcomingInterviews = DB::table('tr_hr_pelamar_interview_main')
            ->whereDate('date_interview', ">=", now()->toDateString())
            ->orderBy('date_interview')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'totalApplicants',
            'confirmedApplicants',
            'todayInterviews',
            'newEmployees',
            'userStats',
            'upcomingInterviews'
        ));
    }
}
