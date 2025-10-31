<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarMain;

class PelamarInterview extends Component
{
    public $pelamarId;
    public $interviews;

    public function mount($pelamarId)
    {
        $this->pelamarId = $pelamarId;
        $this->loadInterviews();
    }

    public function loadInterviews()
    {
        $pelamar = TrHrPelamarMain::with('hasilInterview')->find($this->pelamarId);
        $this->interviews = $pelamar && $pelamar->hasilInterview ? $pelamar->hasilInterview : [];
    }

    public function render()
    {
        return view('livewire.pelamar-interview');
    }
}
