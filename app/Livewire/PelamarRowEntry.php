<?php

namespace App\Livewire;

use Livewire\Component;

class PelamarRowEntry extends Component
{
    public $successMessage;
    public $tr_hr_pelamar_main_id;
    public $nama;
    public $email;
    public $no_hp;
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
    public $status;
    public $asalLamaranOptions = [];

    public function mount()
    {
        $this->asalLamaranOptions = \App\Models\MsHrFrom::all();
    }

    public function simpanPelamar()
    {
        $validated = $this->validate([
            'tr_hr_pelamar_main_id' => 'nullable|string|max:50',
            'nama' => 'required|string|max:50',
            'email' => 'nullable|email|max:50',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            // 'created_at' => 'nullable|date',
            // 'updated_at' => 'nullable|date',
            'rating' => 'nullable|integer',
            'cek_confirm' => 'nullable|boolean',
            'time_confirm' => 'nullable',
            'cek_cv' => 'nullable|boolean',
            'cek_driver' => 'nullable|boolean',
            'cek_interview' => 'nullable|boolean',
            'cek_kandidat' => 'nullable|boolean',
            'cek_priority' => 'nullable|boolean',
            'cek_tolak' => 'nullable|boolean',
            'cek_wa' => 'nullable|boolean',
            'time_cv' => 'nullable',
            'time_interview' => 'nullable',
            'time_wa' => 'nullable',
            'link_cv' => 'nullable|string',
        ]);

    $validated['tr_hr_pelamar_main_id'] = $validated['email'];
    \App\Models\TrHrPelamarMain::create($validated);

        $this->reset([
            'tr_hr_pelamar_main_id', 'nama', 'email', 'no_hp', 'status',
            'rating', 'cek_confirm', 'time_confirm', 'cek_cv', 'cek_driver', 'cek_interview',
            'cek_kandidat', 'cek_priority', 'cek_tolak', 'cek_wa', 'time_cv', 'time_interview',
            'time_wa', 'link_cv'
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
