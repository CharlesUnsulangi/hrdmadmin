<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TrHrPkwtt;

class PkwttController extends Controller
{
    // Promote PKWTT to Employee
    // ...existing code...

    public function promote($id)
    {
        $pkwtt = \App\Models\TrHrPkwtt::findOrFail($id);
        $empId = $pkwtt->ms_emp_id;
        $employee = \App\Models\MsEmployee::find($empId);

        // If employee does not exist, create new
        if (!$employee) {
            $employee = new \App\Models\MsEmployee();
            $employee->emp_id = $empId;
            $employee->emp_name = $empId; // Optionally fetch name from kandidat if available
        }

        // Update employee fields from PKWTT
        $employee->emp_statuskaryawan = 'PKWTT';
        $employee->emp_datejoin = $pkwtt->date_pkwtt_start;
        $employee->emp_expdatekontrak = $pkwtt->date_pkwtt_end;
        $employee->emp_nokontrak = $pkwtt->tr_hd_pkwtt_id;
        $employee->emp_last_contract = $pkwtt->tr_hd_pkwtt_id;
        $employee->emp_status = 1; // Aktif
        $employee->rec_status = 1;
        $employee->save();

        return redirect()->route('pkwtt.edit', $id)->with('success', 'PKWTT telah dijadikan karyawan.');
    }

    public function destroy($id)
    {
        $pkwtt = \App\Models\TrHrPkwtt::findOrFail($id);
        $pkwtt->delete();
        return redirect()->route('pkwtt.index')->with('success', 'PKWTT berhasil dihapus.');
    }

    public function index(Request $request)
    {
        $query = TrHrPkwtt::query();

        // Search by ID PKWTT, ID kandidat/karyawan, atau nama
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function($sub) use ($q) {
                $sub->where('tr_hd_pkwtt_id', 'like', "%$q%")
                    ->orWhere('ms_emp_id', 'like', "%$q%")
                    ->orWhereRaw("EXISTS (SELECT 1 FROM ms_hr_kandidat WHERE ms_hr_kandidat_emp_id = tr_hr_pkwtt.ms_emp_id AND ms_hr_kandidat_emp_id LIKE ?)", ["%$q%"]);
            });
        }

        // Filter status tanda tangan (dummy: hanya 'menunggu' untuk sekarang)
        if ($request->filled('status')) {
            // Implementasi status dinamis nanti, sekarang hanya dummy
            // $query->where('status', $request->input('status'));
        }

        // Sort
        $sort = $request->input('sort', 'date_pkwtt_start');
        $dir = $request->input('dir', 'desc');
        $allowedSort = ['tr_hd_pkwtt_id','ms_emp_id','date_pkwtt_start','date_pkwtt_end','date_sign','month'];
        if (!in_array($sort, $allowedSort)) $sort = 'date_pkwtt_start';
        if (!in_array($dir, ['asc','desc'])) $dir = 'desc';
        $query->orderBy($sort, $dir);

        $list = $query->get();
        return view('pkwtt.index', compact('list'));
    }

    public function create(Request $request)
    {
        $ms_emp_id = $request->get('ms_emp_id', '');
        $employee = null;
        if ($ms_emp_id) {
            $employee = \App\Models\MsEmployee::find($ms_emp_id);
        }
        return view('pkwtt.create', compact('ms_emp_id', 'employee'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ms_emp_id' => 'required|string|max:50',
            'date_pkwtt_start' => 'required|date',
            'date_pkwtt_end' => 'required|date|after:date_pkwtt_start',
            'date_sign' => 'required|date',
            'month' => 'required|integer|min:1',
        ]);

        $pkwttId = 'PKWTT-' . $validated['ms_emp_id'] . '-' . date('YmdHis');

        TrHrPkwtt::create([
            'tr_hd_pkwtt_id' => $pkwttId,
            'ms_emp_id' => $validated['ms_emp_id'],
            'date_pkwtt_start' => $validated['date_pkwtt_start'],
            'date_pkwtt_end' => $validated['date_pkwtt_end'],
            'date_sign' => $validated['date_sign'],
            'ms_hr_user_id' => auth()->user() ? auth()->user()->id : null,
            'ms_company_id' => null,
            'month' => $validated['month'],
        ]);

        // Update ms_employee
        $employee = \App\Models\MsEmployee::find($validated['ms_emp_id']);
        if ($employee) {
            $employee->emp_datejoin = $validated['date_pkwtt_start'];
            $employee->emp_expdatekontrak = $validated['date_pkwtt_end'];
            $employee->save();
        }

        return redirect()->route('pkwtt.index')->with('success', 'PKWTT berhasil dibuat.');
    }

    public function edit($id)
    {
        $pkwtt = \App\Models\TrHrPkwtt::findOrFail($id);
        return view('pkwtt.edit', compact('pkwtt'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date_pkwtt_start' => 'required|date',
            'date_pkwtt_end' => 'required|date|after:date_pkwtt_start',
            'date_sign' => 'required|date',
            'month' => 'required|integer|min:1',
        ]);
        $pkwtt = \App\Models\TrHrPkwtt::findOrFail($id);
        $pkwtt->update($validated);
        return redirect()->route('pkwtt.show', $id)->with('success', 'PKWTT berhasil diupdate.');
    }

    public function show($id)
    {
        $pkwtt = \App\Models\TrHrPkwtt::findOrFail($id);
        // Relasi kandidat/employee
        $kandidat = \App\Models\MsHrKandidat::find($pkwtt->ms_emp_id);
        $employee = class_exists('App\\Models\\MsEmployee') ? \App\Models\MsEmployee::find($pkwtt->ms_emp_id) : null;
        return view('pkwtt.show', compact('pkwtt', 'kandidat', 'employee'));
    }
}
