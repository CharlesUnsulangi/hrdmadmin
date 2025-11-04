<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrHrBaMain;
use App\Models\TrHrBaPelaku;
use App\Models\TrHrBaLaka;
use App\Models\TrHrBaRevisi;
use App\Models\MsHrUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Base query - get all BA without type filtering initially
        $query = TrHrBaMain::with(['user']) // Disable pelaku, laka, revisi dulu sampai tabel siap
            ->orderBy('tr_hr_ba_id', 'desc'); // Order by ID descending

        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('note_ba', 'like', "%{$search}%")
                  ->orWhere('pelaku_desc', 'like', "%{$search}%")
                  ->orWhereHas('user', function($subQuery) use ($search) {
                      $subQuery->where('username', 'like', "%{$search}%");
                  });
            });
        }

        // Apply type filter if provided
        if ($request->has('type_filter') && $request->type_filter) {
            $typeFilter = $request->type_filter;
            if ($typeFilter === 'GENERAL') {
                // Show only BA that don't have type set
                $query->whereNull('ms_hr_ba_type_id');
            } else {
                // Show BA with specific type
                $query->where('ms_hr_ba_type_id', $typeFilter);
            }
        }

        // Apply date filter if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->where('date_ba', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('date_ba', '<=', $request->date_to);
        }

        // Paginate results
        $beritaAcaras = $query->paginate(15);

        return view('berita-acara.index', compact('beritaAcaras', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // General BA creation - no specific type yet
        $users = MsHrUser::where('is_active', 1)->orderBy('username')->get();
        
        // Get master BA kejadian untuk dropdown
        $masterKejadian = \App\Models\MsHrBaKejadian::orderBy('ms_hr_ba_kejadian_desc', 'asc')->get();
        
        return view('berita-acara.create', compact('users', 'masterKejadian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug log
        \Log::info('BeritaAcara Store Request:', $request->all());
        
        // Validation rules for general BA
        $rules = [
            'date_ba' => 'required|date',
            'note_ba' => 'required|string|min:5', // Nama kejadian minimal 5 karakter
            'kronologi' => 'required|string|min:20', // Kronologi minimal 20 karakter
            'pelaku_desc' => 'nullable|string|max:255',
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // Generate next ID
            $nextId = TrHrBaMain::max('tr_hr_ba_id') + 1;

            // Create main BA record (without specific type yet)
            \Log::info('Creating General BA with data:', [
                'tr_hr_ba_id' => $nextId,
                'ms_user_id' => Auth::id(),
                'date_ba' => $request->date_ba,
                'note_ba' => $request->note_ba,
                'kronologi' => $request->kronologi,
                'pelaku_desc' => $request->pelaku_desc,
            ]);

            $baMain = TrHrBaMain::create([
                'tr_hr_ba_id' => $nextId,
                'ms_user_id' => Auth::id(),
                'date_ba' => $request->date_ba,
                'note_ba' => $request->note_ba,
                'kronologi' => $request->kronologi,
                'ms_hr_ba_type_id' => null, // Will be set later when adding details
                'pelaku_desc' => $request->pelaku_desc,
            ]);

            \Log::info('General BA created with ID: ' . $baMain->tr_hr_ba_id);

            DB::commit();

            return redirect()->route('berita-acara.show', $baMain->tr_hr_ba_id)
                ->with('success', 'Berita Acara berhasil dibuat! Sekarang tentukan jenis dan tambahkan detail.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('BeritaAcara Store Error: ' . $e->getMessage());
            \Log::error('Error Line: ' . $e->getLine());
            \Log::error('Error File: ' . $e->getFile());
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beritaAcara = TrHrBaMain::with(['user']) // Disable relasi lain dulu
            ->findOrFail($id);
        
        return view('berita-acara.show', compact('beritaAcara'));
    }

    /**
     * Show form to add type-specific details (Step 2 of 2-step process).
     */
    public function addDetails(Request $request, string $id)
    {
        $beritaAcara = TrHrBaMain::with(['user'])->findOrFail($id);
        $type = $request->get('type');
        
        // Validate type
        if (!in_array($type, ['TEMUAN', 'LAKA', 'REVISI'])) {
            return redirect()->route('berita-acara.show', $id)
                ->with('error', 'Jenis BA tidak valid');
        }
        
        // Check if BA already has type
        if ($beritaAcara->ms_hr_ba_type_id) {
            return redirect()->route('berita-acara.show', $id)
                ->with('warning', 'BA ini sudah memiliki jenis yang ditentukan');
        }
        
        return view('berita-acara.add-details', compact('beritaAcara', 'type'));
    }

    /**
     * Store type-specific details (Step 2 of 2-step process).
     */
    public function storeDetails(Request $request, string $id)
    {
        $beritaAcara = TrHrBaMain::findOrFail($id);
        $type = $request->input('type');
        
        Log::info("Store Details Request", ['id' => $id, 'type' => $type, 'all_data' => $request->all()]);
        
        try {
            DB::beginTransaction();
            
            // Update BA main with type
            $beritaAcara->ms_hr_ba_type_id = $type;
            $beritaAcara->save();
            
            // Store type-specific details
            if ($type === 'LAKA') {
                $request->validate([
                    'ms_truck_id' => 'required|string',
                    'ms_driver_id' => 'required|string',
                    'note_kronologi' => 'required|string|min:10'
                ]);
                
                TrHrBaLaka::create([
                    'tr_hr_ba_id' => $beritaAcara->tr_hr_ba_id,
                    'ms_truck_id' => $request->ms_truck_id,
                    'ms_driver_id' => $request->ms_driver_id,
                    'note_kronologi' => $request->note_kronologi
                ]);
                
            } elseif ($type === 'TEMUAN') {
                // TODO: Implement when tr_hr_ba_pelaku table is ready
                return redirect()->route('berita-acara.show', $id)
                    ->with('info', 'Tabel pelaku belum tersedia. BA berhasil diset sebagai TEMUAN.');
                    
            } elseif ($type === 'REVISI') {
                // TODO: Implement when tr_hr_ba_revisi table is ready
                return redirect()->route('berita-acara.show', $id)
                    ->with('info', 'Tabel revisi belum tersedia. BA berhasil diset sebagai REVISI.');
            }
            
            DB::commit();
            
            return redirect()->route('berita-acara.show', $id)
                ->with('success', 'Detail ' . $type . ' berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error storing BA details', [
                'id' => $id,
                'type' => $type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan detail: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beritaAcara = TrHrBaMain::with(['user']) // Disable relasi lain dulu
            ->findOrFail($id);
        
        $users = MsHrUser::active()->orderBy('username')->get();
        $type = $beritaAcara->ms_hr_ba_type_id;
        
        // Get additional data based on type
        $trucks = [];
        $drivers = [];
        
        if ($type === 'LAKA') {
            // Assuming these tables exist - uncomment when available
            // $trucks = MsTruck::where('active', 1)->orderBy('truck_name')->get();
            // $drivers = MsDriver::where('active', 1)->orderBy('driver_name')->get();
        }
        
        return view('berita-acara.edit', compact('beritaAcara', 'users', 'type', 'trucks', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beritaAcara = TrHrBaMain::findOrFail($id);
        
        // Same validation as store
        $rules = [
            'date_ba' => 'required|date',
            'note_ba' => 'required|string',
            'pelaku_desc' => 'nullable|string|max:50',
        ];

        // Add type-specific validation
        if ($beritaAcara->ms_hr_ba_type_id === 'TEMUAN') {
            $rules['pelaku.*.ms_user_id'] = 'required|string|max:50';
            $rules['pelaku.*.text_ba'] = 'required|string|max:50';
            $rules['pelaku.*.date_ba'] = 'required|date';
            $rules['pelaku.*.ms_type_ba_pelaku_id'] = 'required|string|max:50';
        } elseif ($beritaAcara->ms_hr_ba_type_id === 'LAKA') {
            $rules['ms_truck_id'] = 'required|string|max:50';
            $rules['ms_driver_id'] = 'required|string|max:50';
            $rules['note_kronologi'] = 'required|string';
        } elseif ($beritaAcara->ms_hr_ba_type_id === 'REVISI') {
            $rules['revisi.*.field'] = 'required|string|max:50';
            $rules['revisi.*.reason_desc'] = 'required|string|max:255';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // Update main BA record
            $beritaAcara->update([
                'date_ba' => $request->date_ba,
                'note_ba' => $request->note_ba,
                'pelaku_desc' => $request->pelaku_desc,
            ]);

            // Handle type-specific updates
            if ($beritaAcara->ms_hr_ba_type_id === 'TEMUAN') {
                // Delete existing pelaku records
                $beritaAcara->pelaku()->delete();
                
                // Create new pelaku records
                if ($request->has('pelaku')) {
                    foreach ($request->pelaku as $pelakuData) {
                        TrHrBaPelaku::create([
                            'tr_hr_ba_id' => $beritaAcara->tr_hr_ba_id,
                            'ms_user_id' => $pelakuData['ms_user_id'],
                            'text_ba' => $pelakuData['text_ba'],
                            'date_ba' => $pelakuData['date_ba'],
                            'ms_type_ba_pelaku_id' => $pelakuData['ms_type_ba_pelaku_id'],
                            'cek_fraud' => isset($pelakuData['cek_fraud']) ? 1 : 0,
                            'cek_pelanggaran' => isset($pelakuData['cek_pelanggaran']) ? 1 : 0,
                            'cek_kode_etik' => isset($pelakuData['cek_kode_etik']) ? 1 : 0,
                            'cek_disiplin' => isset($pelakuData['cek_disiplin']) ? 1 : 0,
                            'cek_berulang' => isset($pelakuData['cek_berulang']) ? 1 : 0,
                        ]);
                    }
                }
            } elseif ($beritaAcara->ms_hr_ba_type_id === 'LAKA') {
                $beritaAcara->laka()->updateOrCreate(
                    ['tr_hr_ba_id' => $beritaAcara->tr_hr_ba_id],
                    [
                        'ms_truck_id' => $request->ms_truck_id,
                        'ms_driver_id' => $request->ms_driver_id,
                        'note_kronologi' => $request->note_kronologi,
                    ]
                );
            } elseif ($beritaAcara->ms_hr_ba_type_id === 'REVISI') {
                // Delete existing revisi records
                $beritaAcara->revisi()->delete();
                
                // Create new revisi records
                if ($request->has('revisi')) {
                    foreach ($request->revisi as $revisiData) {
                        TrHrBaRevisi::create([
                            'tr_hr_ba_main_id' => $beritaAcara->tr_hr_ba_id,
                            'ms_user_id' => Auth::id(),
                            'field' => $revisiData['field'],
                            'qty_salah' => $revisiData['qty_salah'] ?? null,
                            'qty_benar' => $revisiData['qty_benar'] ?? null,
                            'date_salah' => $revisiData['date_salah'] ?? null,
                            'date_benar' => $revisiData['date_benar'] ?? null,
                            'money_salah' => $revisiData['money_salah'] ?? null,
                            'money_benar' => $revisiData['money_benar'] ?? null,
                            'text_salah' => $revisiData['text_salah'] ?? null,
                            'text_benar' => $revisiData['text_benar'] ?? null,
                            'reason_desc' => $revisiData['reason_desc'],
                            'database_name' => $revisiData['database_name'] ?? null,
                            'field_name' => $revisiData['field_name'] ?? null,
                            'query_id' => $revisiData['query_id'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('berita-acara.index', ['type' => $beritaAcara->ms_hr_ba_type_id])
                ->with('success', 'Berita Acara berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $beritaAcara = TrHrBaMain::findOrFail($id);
            $type = $beritaAcara->ms_hr_ba_type_id;
            
            DB::beginTransaction();
            
            // Delete related records first
            $beritaAcara->pelaku()->delete();
            $beritaAcara->laka()->delete();
            $beritaAcara->revisi()->delete();
            
            // Delete main record
            $beritaAcara->delete();
            
            DB::commit();

            return redirect()->route('berita-acara.index', ['type' => $type])
                ->with('success', 'Berita Acara berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
