<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarInterviewSpv;
use App\Models\TrHrPelamarInterviewMgt;
use App\Models\TrHrPelamarInterviewHrd;
use App\Models\TrHrPelamarInterviewFinance;
use App\Models\TrHrPelamarInterviewBod;
use App\Models\TrHrPelamarInterviewAdmin;

class InterviewManagementController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $data = collect();
        $types = [
            'spv' => TrHrPelamarInterviewSpv::class,
            'mgt' => TrHrPelamarInterviewMgt::class,
            'hrd' => TrHrPelamarInterviewHrd::class,
            'finance' => TrHrPelamarInterviewFinance::class,
            'bod' => TrHrPelamarInterviewBod::class,
            'admin' => TrHrPelamarInterviewAdmin::class,
        ];
        if ($type && isset($types[$type])) {
            $data = $types[$type]::with('pelamar')->get()->map(function($row) use ($type) {
                return $this->mapInterviewRow($row, $type);
            });
        } else {
            foreach ($types as $key => $model) {
                $rows = $model::with('pelamar')->get()->map(function($row) use ($key) {
                    return $this->mapInterviewRow($row, $key);
                });
                $data = $data->concat($rows);
            }
        }
        // Sort by date_interview desc, time_start desc
        $data = $data->sortByDesc(function($row) {
            return $row['date_interview'].' '.$row['time_start'];
        });
        return view('manajemen_interview.index', [
            'interviews' => $data,
            'types' => array_keys($types),
            'selectedType' => $type,
        ]);
    }

    private function mapInterviewRow($row, $type)
    {
        return [
            'id' => $row->tr_hr_pelamar_operator_id,
            'type' => strtoupper($type),
            'pelamar' => $row->pelamar->nama ?? '-',
            'date_interview' => $row->date_interview,
            'time_start' => $row->time_start,
            'time_end' => $row->time_end,
            'rating_final' => $row->rating_final,
            'cek_offline' => $row->cek_offline,
            'cek_online' => $row->cek_online,
            'red_flag' => $row->red_flag,
            'green_flag' => $row->green_flag,
            'note_interview' => $row->note_interview,
        ];
    }
}
