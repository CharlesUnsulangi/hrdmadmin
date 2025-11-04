<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsAdminSp;
use Illuminate\Support\Facades\DB;

class AdminItController extends Controller
{
    public function ajaxExecute($id)
    {
        try {
            $sp = MsAdminSp::findOrFail($id);
            $result = \DB::select('EXEC ' . $sp->ms_admin_sp_id);
            return response()->json(['data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function index()
    {
        $sps = MsAdminSp::select('ms_admin_sp_id', 'sp_desc')->get();
        return view('admin_it.index', compact('sps'));
    }

    public function execute($id)
    {
        $sp = MsAdminSp::findOrFail($id);
        // Eksekusi SP sesuai nama
        $result = DB::select('EXEC ' . $sp->ms_admin_sp_id);
        return back()->with('success', 'Stored Procedure ' . $sp->ms_admin_sp_id . ' berhasil dijalankan.');
    }
}
