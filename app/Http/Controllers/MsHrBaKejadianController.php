<?php

namespace App\Http\Controllers;

use App\Models\MsHrBaKejadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MsHrBaKejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MsHrBaKejadian::query()->orderBy('ms_hr_ba_kejadian_id', 'desc');

        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $kejadians = $query->paginate(15);

        if ($request->ajax()) {
            return view('master.ba-kejadian.table', compact('kejadians'))->render();
        }

        return view('master.ba-kejadian.index', compact('kejadians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.ba-kejadian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ms_hr_ba_kejadian_desc' => 'required|string|max:100|unique:ms_hr_ba_kejadian,ms_hr_ba_kejadian_desc',
        ], [
            'ms_hr_ba_kejadian_desc.required' => 'Deskripsi kejadian harus diisi',
            'ms_hr_ba_kejadian_desc.max' => 'Deskripsi kejadian maksimal 100 karakter',
            'ms_hr_ba_kejadian_desc.unique' => 'Deskripsi kejadian sudah ada',
        ]);

        try {
            DB::beginTransaction();

            // Generate next ID
            $nextId = MsHrBaKejadian::max('ms_hr_ba_kejadian_id') + 1;

            MsHrBaKejadian::create([
                'ms_hr_ba_kejadian_id' => $nextId,
                'ms_hr_ba_kejadian_desc' => $request->ms_hr_ba_kejadian_desc,
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Master BA Kejadian berhasil ditambahkan!'
                ]);
            }

            return redirect()->route('ms-hr-ba-kejadian.index')
                ->with('success', 'Master BA Kejadian berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating Master BA Kejadian', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan Master BA Kejadian: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan Master BA Kejadian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kejadian = MsHrBaKejadian::findOrFail($id);
        return view('master.ba-kejadian.show', compact('kejadian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kejadian = MsHrBaKejadian::findOrFail($id);
        return view('master.ba-kejadian.edit', compact('kejadian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kejadian = MsHrBaKejadian::findOrFail($id);

        $request->validate([
            'ms_hr_ba_kejadian_desc' => 'required|string|max:100|unique:ms_hr_ba_kejadian,ms_hr_ba_kejadian_desc,' . $id . ',ms_hr_ba_kejadian_id',
        ], [
            'ms_hr_ba_kejadian_desc.required' => 'Deskripsi kejadian harus diisi',
            'ms_hr_ba_kejadian_desc.max' => 'Deskripsi kejadian maksimal 100 karakter',
            'ms_hr_ba_kejadian_desc.unique' => 'Deskripsi kejadian sudah ada',
        ]);

        try {
            DB::beginTransaction();

            $kejadian->update([
                'ms_hr_ba_kejadian_desc' => $request->ms_hr_ba_kejadian_desc,
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Master BA Kejadian berhasil diupdate!'
                ]);
            }

            return redirect()->route('ms-hr-ba-kejadian.index')
                ->with('success', 'Master BA Kejadian berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating Master BA Kejadian', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupdate Master BA Kejadian: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate Master BA Kejadian: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kejadian = MsHrBaKejadian::findOrFail($id);
            $kejadian->delete();

            return response()->json([
                'success' => true,
                'message' => 'Master BA Kejadian berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting Master BA Kejadian', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus Master BA Kejadian: ' . $e->getMessage()
            ], 500);
        }
    }
}