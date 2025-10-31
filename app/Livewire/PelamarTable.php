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

        $pelamars = \App\Models\TrHrPelamarMain::orderBy($this->sortField, $this->sortDirection)->paginate(50);
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
}
