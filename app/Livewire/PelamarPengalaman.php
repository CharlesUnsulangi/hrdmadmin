<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarMain;
use App\Models\TrHrPelamarPengalamanPerusahaan;

class PelamarPengalaman extends Component
{
    public $pelamarId;
    public $pengalamanList = [];
    public $showForm = false;
    public $editId = null;
    public $form = [
        'perusahaan' => '',
        'jabatan_awal' => '',
        'jabatan_akhir' => '',
        'tgl_start' => '',
        'tgl_end' => '',
        'gaji_awal' => '',
        'gaji_akhir' => '',
        'alasan_resign' => '',
    ];

    public function mount($pelamarId)
    {
        $this->pelamarId = $pelamarId;
        $this->loadPengalaman();
    }

    public function loadPengalaman()
    {
        $pelamar = TrHrPelamarMain::with('pengalaman')->where('tr_hr_pelamar_main_id', $this->pelamarId)->first();
        $this->pengalamanList = $pelamar && $pelamar->pengalaman ? $pelamar->pengalaman : [];
    }

    public function showAddForm()
    {
        \Log::info('showAddForm method called'); // Debug log
        $this->resetForm();
        $this->showForm = true;
        $this->editId = null;
        
        // Emit event untuk debugging
        $this->dispatch('form-toggled', ['showForm' => $this->showForm]);
    }

    public function showEditForm($id)
    {
        $pengalaman = TrHrPelamarPengalamanPerusahaan::findOrFail($id);
        $this->form = [
            'perusahaan' => $pengalaman->perusahaan,
            'jabatan_awal' => $pengalaman->jabatan_awal,
            'jabatan_akhir' => $pengalaman->jabatan_akhir,
            'tgl_start' => $pengalaman->tgl_start,
            'tgl_end' => $pengalaman->tgl_end,
            'gaji_awal' => $pengalaman->gaji_awal,
            'gaji_akhir' => $pengalaman->gaji_akhir,
            'alasan_resign' => $pengalaman->alasan_resign,
        ];
        $this->showForm = true;
        $this->editId = $id;
    }

    public function savePengalaman()
    {
        $data = $this->validate([
            'form.perusahaan' => 'required|string|max:50',
            'form.jabatan_awal' => 'nullable|string|max:50',
            'form.jabatan_akhir' => 'nullable|string|max:50',
            'form.tgl_start' => 'required|date',
            'form.tgl_end' => 'required|date',
            'form.gaji_awal' => 'nullable|numeric',
            'form.gaji_akhir' => 'nullable|numeric',
            'form.alasan_resign' => 'nullable|string',
        ])['form'];
        
        $data['tr_hr_pelamar_id'] = $this->pelamarId;
        
        if ($this->editId) {
            $pengalaman = TrHrPelamarPengalamanPerusahaan::findOrFail($this->editId);
            $pengalaman->update($data);
        } else {
            TrHrPelamarPengalamanPerusahaan::create($data);
        }
        $this->showForm = false;
        $this->editId = null;
        $this->resetForm();
        $this->loadPengalaman();
        
        session()->flash('success', 'Pengalaman berhasil disimpan!');
    }

    public function resetForm()
    {
        $this->form = [
            'perusahaan' => '',
            'jabatan_awal' => '',
            'jabatan_akhir' => '',
            'tgl_start' => '',
            'tgl_end' => '',
            'gaji_awal' => '',
            'gaji_akhir' => '',
            'alasan_resign' => '',
        ];
    }

    public function render()
    {
        return view('livewire.pelamar-pengalaman');
    }
}
