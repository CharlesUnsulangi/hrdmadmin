<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrPelamarMain;

class PelamarController extends Controller
{
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
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil diupdate');
    }

    public function destroy($id)
    {
    $pelamar = TrHrPelamarMain::where('tr_hr_pelamar_main_id', $id)->firstOrFail();
        $pelamar->delete();
        return redirect()->route('pelamar.index')->with('success', 'Pelamar berhasil dihapus');
    }

    // Aksi pelamar
    public function jadikanKandidat($id)
    {
        // TODO: Salin data pelamar ke tabel kandidat
        return back()->with('success', 'Pelamar dijadikan kandidat.');
    }
    public function interview($id)
    {
        // TODO: Tampilkan form interview
        return back();
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
        // TODO: Konfirmasi jadwal interview
        return back()->with('success', 'Jadwal interview dikonfirmasi.');
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
