<?php

namespace App\Livewire;

use Livewire\Component;

class PelamarRowEntry extends Component
{
    public $successMessage;
    public $tr_hr_pelamar_id;
    public $nama;
    public $email;
    public $hp;
    public $posisi;
    public $user_created;
    public $date_created;
    public $rating;
    public $cek_confirm;
    public $time_confirm;
    public $cek_cv;
    public $cek_driver;
    public $cek_interview;
    public $cek_kandidat;
    public $cek_priority;
    public $cek_tolak;
    public $cek_wa;
    public $time_cv;
    public $time_interview;
    public $time_wa;
    public $link_cv;
    public $asal_lamaran;
    public $ms_hr_from_id;
    public $status;
    public $asalLamaranOptions = [];

    public function mount()
    {
        $this->asalLamaranOptions = \App\Models\MsHrFrom::all();
    }

    public function simpanPelamar()
    {
        $validated = $this->validate([
            'tr_hr_pelamar_id' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'hp' => 'nullable|string|max:50',
            'posisi' => 'nullable|string|max:100',
            'user_created' => 'nullable|string|max:50',
            'date_created' => 'nullable|date',
            'rating' => 'nullable|integer|min:1|max:5',
            'cek_confirm' => 'nullable|boolean',
            'time_confirm' => 'nullable|date',
            'cek_cv' => 'nullable|boolean',
            'cek_driver' => 'nullable|boolean',
            'cek_interview' => 'nullable|boolean',
            'cek_kandidat' => 'nullable|boolean',
            'cek_priority' => 'nullable|boolean',
            'cek_tolak' => 'nullable|boolean',
            'cek_wa' => 'nullable|boolean',
            'time_cv' => 'nullable|date',
            'time_interview' => 'nullable|date',
            'time_wa' => 'nullable|date',
            'link_cv' => 'nullable|string|max:255',
            'asal_lamaran' => 'nullable|string|max:100',
            'ms_hr_from_id' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
        ]);

        \App\Models\TrHrPelamarMain::create($validated);

        $this->reset([
            'tr_hr_pelamar_id', 'nama', 'email', 'hp', 'posisi', 'user_created', 'date_created',
            'rating', 'cek_confirm', 'time_confirm', 'cek_cv', 'cek_driver', 'cek_interview',
            'cek_kandidat', 'cek_priority', 'cek_tolak', 'cek_wa', 'time_cv', 'time_interview',
            'time_wa', 'link_cv', 'asal_lamaran', 'ms_hr_from_id', 'status'
        ]);
        $this->successMessage = 'Data pelamar berhasil disimpan!';
        $this->mount(); // refresh dropdown asal lamaran
        $this->dispatch('pelamarAdded');
    }

    public function render()
    {
        return view('livewire.pelamar-row-entry');
    }
}
