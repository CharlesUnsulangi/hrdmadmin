<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarMain;
use App\Models\MsHrFrom;
use Illuminate\Validation\Rule;

class FormPelamar extends Component
{
    public $tr_hr_pelamar_main_id;
    public $nama;
    public $email;
    public $no_hp;
    public $rating = 0;
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
    public $asal_lamaran_options = [];
    protected function rules()
    {
        return [
            'tr_hr_pelamar_main_id' => 'nullable|string|max:50',
            'nama' => 'required|string|max:50',
            'email' => 'nullable|email|max:50',
            'no_hp' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
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
            'cek_shortlist' => 'nullable|boolean',
            'cek_helper' => 'nullable|boolean',
            'cek_staff' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->asal_lamaran_options = MsHrFrom::pluck('form_hr_desc', 'ms_hr_from_id')->toArray();
    }
    public function simpan()
    {
        $validated = $this->validate();
        $validated['tr_hr_pelamar_main_id'] = $validated['email'];
        $validated['cek_shortlist'] = true;
        $validated['cek_staff'] = true;
        $validated['cek_driver'] = false;
        $validated['cek_helper'] = false;
        TrHrPelamarMain::create($validated);
        $this->reset([
            'tr_hr_pelamar_main_id', 'nama', 'email', 'no_hp', 'status',
            'rating', 'cek_confirm', 'time_confirm', 'cek_cv', 'cek_driver', 'cek_interview',
            'cek_kandidat', 'cek_priority', 'cek_tolak', 'cek_wa', 'time_cv', 'time_interview',
            'time_wa', 'link_cv', 'cek_shortlist', 'cek_helper', 'cek_staff'
        ]);
        session()->flash('success', 'Data pelamar berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.form-pelamar', [
            'asal_lamaran_options' => $this->asal_lamaran_options,
        ]);
    }
}
