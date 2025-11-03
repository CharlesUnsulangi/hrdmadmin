<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarMain;
use Spatie\GoogleCalendar\Event;

class PelamarController extends Controller
{
    // Tambah method show untuk menghindari error resource route
    public function show($id)
    {
        return redirect()->route('pelamar.edit', $id);
    }
    public function checkId(Request $request)
    {
        $emails = $request->input('emails', []);
        $exists = [];
        if (!empty($emails)) {
            $exists = TrHrPelamarMain::whereIn('tr_hr_pelamar_main_id', $emails)->pluck('tr_hr_pelamar_main_id')->toArray();
        }
        return response()->json(['exists' => $exists]);
    }
    public function index()
    {
        $pelamars = TrHrPelamarMain::all();
        return view('pelamar.index', compact('pelamars'));
    }

    public function create()
    {
        return view('pelamar.create');
    }

    public function store(Request $request)
    {
        $rows = $request->input('rows', []);
        $success = 0;
        foreach ($rows as $row) {
            $validated = validator($row, [
                'nama' => 'required|string|max:50',
                'email' => 'required|email|max:50',
                'no_hp' => 'required|string|max:50',
                'ms_hr_from_id' => 'nullable|string|max:50',
                'rating' => 'nullable|integer|min:0|max:5',
                'status' => 'nullable|string|max:50',
            ])->validate();
            $validated['tr_hr_pelamar_main_id'] = $validated['email'];
            $validated['date_created'] = now();
            $validated['cek_shortlist'] = true;
            $validated['cek_staff'] = true;
            $validated['cek_driver'] = false;
            $validated['cek_helper'] = false;
            TrHrPelamarMain::create($validated);
            $success++;
        }
        return redirect()->route('pelamar.index')->with('success', $success.' pelamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        $personal = $pelamar->personal;
        $sosmed = $pelamar->sosmed;
        return view('pelamar.edit', compact('pelamar', 'personal', 'sosmed'));
    }

    public function update(Request $request, $id)
    {
        $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'cek_confirm' => 'nullable|boolean',
            'time_confirm' => 'nullable|date',
            'cek_cv' => 'nullable|boolean',
            'cek_driver' => 'nullable|boolean',
            'cek_interview' => 'nullable|boolean',
            'cek_kandidat' => 'nullable|boolean',
            'cek_priority' => 'nullable|boolean',
            'cek_tolak' => 'nullable|boolean',
            'cek_wa' => 'nullable|boolean',
            'time_cv' => 'nullable|date',
            'time_interview' => 'nullable|date',
            'time_wa' => 'nullable|date',
            'link_cv' => 'nullable|string|max:255',
        ]);
        $pelamar->update($validated);
        return redirect()->route('pelamar.edit', $id)->with('success', 'Pelamar berhasil diupdate');
    }

    public function destroy($id)
    {
    $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        $pelamar->delete();
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil dihapus');
    }

    // Method untuk handle pengalaman kerja
    public function storePengalaman(Request $request, $pelamarId)
    {
        $validated = $request->validate([
            'perusahaan' => 'required|string|max:50',
            'jabatan_awal' => 'nullable|string|max:50',
            'jabatan_akhir' => 'nullable|string|max:50',
            'tgl_start' => 'required|date',
            'tgl_end' => 'required|date',
            'gaji_awal' => 'nullable|numeric',
            'gaji_akhir' => 'nullable|numeric',
            'alasan_resign' => 'nullable|string',
            'hp_hrd' => 'nullable|string|max:50',
            'nama_hrd' => 'nullable|string|max:50',
            'hp_atasan' => 'nullable|string|max:50',
        ]);

        // Set default values untuk field yang required di database
        $validated['tr_hr_pelamar_id'] = $pelamarId;
        $validated['hp_hrd'] = $validated['hp_hrd'] ?: '';
        $validated['nama_hrd'] = $validated['nama_hrd'] ?: '';
        $validated['hp_atasan'] = $validated['hp_atasan'] ?: '';
        
        \App\Models\TrHrPelamarPengalamanPerusahaan::create($validated);
        
        return redirect()->back()->with('success', 'Pengalaman kerja berhasil ditambahkan!');
    }

    public function destroyPengalaman($id)
    {
        $pengalaman = \App\Models\TrHrPelamarPengalamanPerusahaan::findOrFail($id);
        $pengalaman->delete();
        
        return redirect()->back()->with('success', 'Pengalaman kerja berhasil dihapus!');
    }

    // Aksi pelamar
    public function jadikanKandidat($id)
    {
        // Ambil data pelamar
        $pelamar = \App\Models\TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();

        // Cek apakah sudah ada kandidat dengan primary key yang sama
        $kandidatExists = \App\Models\MsHrKandidat::where('ms_hr_kandidat_emp_id', $pelamar->tr_hr_pelamar_main_id)->exists();
        if ($kandidatExists) {
            return back()->with('warning', 'Pelamar ini sudah menjadi kandidat.');
        }

        // Salin data ke ms_hr_kandidat
        $kandidatData = [
            'ms_hr_kandidat_emp_id' => $pelamar->tr_hr_pelamar_main_id,
            // Mapping field lain sesuai kebutuhan, default null jika tidak ada di pelamar
            'ms_status_id' => null,
            'ms_user_id' => null,
            'date_kandidat' => now(),
            'date_emp' => null,
            'date_hrd_approve' => null,
            'date_finance_approve' => null,
            'date_bod_approve' => null,
            'rating_hrd' => null,
            'rating_finance' => null,
            'rating_bod' => null,
            'rating_spv' => null,
            'date_spv' => null,
        ];
        \App\Models\MsHrKandidat::create($kandidatData);

        return back()->with('success', 'Pelamar berhasil dijadikan kandidat.');
    }
    public function interview($id)
    {
    $pelamar = \App\Models\TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
    return view('pelamar.interview', compact('pelamar'));
    }
    public function tolak($id)
    {
        // TODO: Update status pelamar jadi ditolak
        return back()->with('success', 'Pelamar ditolak.');
    }
    public function diskusi($id)
    {
        // TODO: Undang diskusi
        return back();
    }
    public function confirmJadwalInterview($id)
    {
        // Konfirmasi jadwal interview dan create event Google Calendar
        $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->first();
        $start = $pelamar->time_interview ? \Carbon\Carbon::parse($pelamar->time_interview) : now()->addDay();
        $end = (clone $start)->addHour();
        $event = Event::create([
            'name' => 'Interview: ' . ($pelamar ? $pelamar->nama : 'Pelamar'),
            'startDateTime' => $start,
            'endDateTime' => $end,
            'description' => 'Interview kandidat dari sistem HRD',
        ]);
        // Simpan google_event_id ke database
        if ($pelamar && $event && $event->id) {
            $pelamar->google_event_id = $event->id;
            $pelamar->save();
        }
        return back()->with('success', 'Jadwal interview dikonfirmasi & event Google Calendar dibuat.');
    }
    public function reschedule($id)
    {
        // TODO: Tampilkan form reschedule interview
        return back();
    }
    public function backgroundCheck($id)
    {
        // TODO: Tampilkan form background check
        return back();
    }
}
