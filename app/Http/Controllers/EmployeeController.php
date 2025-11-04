<?php
namespace App\Http\Controllers;

use App\Models\MsEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function updateResign(Request $request, $id)
    {
        $employee = MsEmployee::findOrFail($id);
        $employee->emp_inactive = 1;
        $employee->emp_dateresign = $request->input('emp_last_salary_date');
        $employee->save();
        return redirect()->route('employee.edit', $id)->with('success', 'Status resign dan tanggal resign berhasil diupdate.');
    }
    public function index()
    {
    $sortable = ['emp_datejoin', 'emp_dateresign', 'emp_expdatekontrak', 'emp_inactive', 'emp_last_salary_date'];
        $sort = request('sort');
        $order = request('order', 'desc');
        $query = MsEmployee::query();

        // Search by name or email
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('emp_name', 'like', "%$search%")
                  ->orWhere('emp_email', 'like', "%$search%") ;
            });
        }

        // Filter by status
        if (request('status') == 'active') {
            $query->where('emp_inactive', 0);
        } elseif (request('status') == 'inactive') {
            $query->where('emp_inactive', 1);
        }

        // Filter by date join
        if ($datejoin = request('datejoin')) {
            $query->whereDate('emp_datejoin', $datejoin);
        }

        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $order);
        }
        $karyawans = $query->paginate(100)->appends(request()->all());
        return view('employee.index', compact('karyawans', 'sort', 'order'));
    }

    public function edit($id)
    {
        $karyawan = MsEmployee::findOrFail($id);
        return view('employee.edit', compact('karyawan'));
    }

    public function createPkwtt(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'pkwtt_start' => 'required|date',
            'pkwtt_note' => 'nullable|string',
        ]);

        // Simpan data PKWTT (contoh: update field di MsEmployee, atau insert ke tabel lain jika ada)
        $employee = MsEmployee::findOrFail($id);
        $employee->emp_statuskaryawan = 'PKWTT';
        $employee->emp_datejoin = $validated['pkwtt_start'];
        $employee->save();

        // Jika ada tabel khusus PKWTT, insert juga ke sana di sini

        return redirect()->route('employee.edit', $id)->with('success', 'PKWTT berhasil dibuat.');
    }
}
