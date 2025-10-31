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

    public function toggleFormInput()
    {
        $this->showFormInput = !$this->showFormInput;
    }

    public function render()
    {
        $asalLamaranOptions = MsHrFrom::all();
        $pelamars = \App\Models\TrHrPelamarMain::paginate(10);
        return view('livewire.pelamar-table', [
            'asalLamaranOptions' => $asalLamaranOptions,
            'pelamars' => $pelamars,
        ]);
    }
}
