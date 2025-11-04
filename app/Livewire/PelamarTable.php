<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\MsHrFrom;


class PelamarTable extends Component
{
    public $showFormInput = false;
    public $asalLamaran;
    public $ratingDefault;
    public $search;
    public $showDetailModal = false;
    public $selectedPelamarId;
    public $tabConfirm = null; // null=semua, 0=belum confirm, 1=confirm

    // Sorting properties
    public $sortField = 'date_created';
    public $sortDirection = 'desc';

    public function toggleFormInput()
    {
        $this->showFormInput = !$this->showFormInput;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $asalLamaranOptions = MsHrFrom::all();
        $namaOptions = \App\Models\TrHrPelamarMain::select('nama')->distinct()->orderBy('nama')->pluck('nama');
        $emailOptions = \App\Models\TrHrPelamarMain::select('email')->distinct()->orderBy('email')->pluck('email');
        $statusOptions = \App\Models\TrHrPelamarMain::select('status')->distinct()->orderBy('status')->pluck('status');

        $query = \App\Models\TrHrPelamarMain::query();

        // Filter tab confirm
        if ($this->tabConfirm !== null) {
            $query->where('cek_confirm', (bool)$this->tabConfirm);
        }
        // Apply filters
        if ($this->asalLamaran) {
            $query->where('asal_lamaran', $this->asalLamaran);
        }
        if ($this->ratingDefault) {
            $query->where('rating', $this->ratingDefault);
        }
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $this->search . '%');
            });
        }
        $pelamars = $query->orderBy($this->sortField, $this->sortDirection)->paginate(50);
        
        return view('livewire.pelamar-table', [
            'asalLamaranOptions' => $asalLamaranOptions,
            'pelamars' => $pelamars,
            'namaOptions' => $namaOptions,
            'emailOptions' => $emailOptions,
            'statusOptions' => $statusOptions,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
        ]);
    }

    public function showDetail($pelamarId)
    {
        $this->selectedPelamarId = $pelamarId;
        $this->showDetailModal = true;
    }

    public function arsipkanPelamar($pelamarId)
    {
        // Logic untuk arsip pelamar
        session()->flash('success', 'Pelamar berhasil diarsipkan');
    }

    public function kirimWa($pelamarId)
    {
        // Logic untuk kirim WA
        session()->flash('success', 'Pesan WA berhasil dikirim');
    }
}
