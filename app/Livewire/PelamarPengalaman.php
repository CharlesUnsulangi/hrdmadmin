<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarMain;

class PelamarPengalaman extends Component
{
    public $pelamarId;
    public $pengalamanList = [];

    public function mount($pelamarId)
    {
        $this->pelamarId = $pelamarId;
        $this->loadPengalaman();
    }

    public function loadPengalaman()
    {
        $pelamar = TrHrPelamarMain::with('pengalaman')->find($this->pelamarId);
        $this->pengalamanList = $pelamar && $pelamar->pengalaman ? $pelamar->pengalaman : [];
    }

    public function render()
    {
        return view('livewire.pelamar-pengalaman');
    }
}
