<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrHrPelamarMain;
use App\Models\TrHrPelamarInterview;
use App\Models\TrHrPelamarSosmed;
use Illuminate\Http\Request;

class PelamarApiController extends Controller
{
    public function getInterviewData($id)
    {
        try {
            $interviews = TrHrPelamarInterview::where('tr_hr_pelamar_main_id', $id)
                ->orderBy('tanggal', 'desc')
                ->get()
                ->map(function ($interview) {
                    return [
                        'tanggal' => $interview->tanggal ? date('d/m/Y', strtotime($interview->tanggal)) : '-',
                        'interviewer' => $interview->interviewer ?? '-',
                        'hasil' => $interview->hasil ?? '-',
                        'catatan' => $interview->catatan ?? '-',
                    ];
                });

            return response()->json($interviews);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load interview data'], 500);
        }
    }

    public function getPersonalData($id)
    {
        try {
            $pelamar = TrHrPelamarMain::find($id);
            
            if (!$pelamar) {
                return response()->json(['error' => 'Pelamar not found'], 404);
            }

            $data = [
                'alamat_ktp' => $pelamar->alamat_ktp ?? '-',
                'alamat_domisili' => $pelamar->alamat_domisili ?? '-',
                'tanggal_lahir' => $pelamar->tanggal_lahir ? date('d/m/Y', strtotime($pelamar->tanggal_lahir)) : '-',
                'agama' => $pelamar->agama ?? '-',
                'status_nikah' => $pelamar->status_nikah ?? '-',
                'pendidikan' => $pelamar->pendidikan_terakhir ?? '-',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load personal data'], 500);
        }
    }

    public function getSosmedData($id)
    {
        try {
            $sosmed = TrHrPelamarSosmed::where('tr_hr_pelamar_main_id', $id)
                ->get()
                ->map(function ($item) {
                    return [
                        'platform' => $item->platform ?? 'Unknown',
                        'username' => $item->username ?? '-',
                        'link' => $item->link ?? '#',
                        'status' => $item->status ?? 'UNVERIFIED',
                    ];
                });

            return response()->json($sosmed);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load social media data'], 500);
        }
    }
}