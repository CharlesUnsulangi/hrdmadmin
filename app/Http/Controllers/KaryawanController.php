<?php
namespace App\Http\Controllers;

use App\Models\MsEmployee;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
    $karyawans = MsEmployee::paginate(100);
    return view('karyawan.index', compact('karyawans'));
    }
}
