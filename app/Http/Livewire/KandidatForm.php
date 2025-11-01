<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MsHrKandidat;
use App\Models\TrHrPelamarMain;

class KandidatForm extends Component
{
    public $mode = 'create';
    public $kandidat;
    public $from_pelamar = false;
    public $pelamar_id;
    public $fields = [
        'ms_hr_kandidat_emp_id' => '',
        'ms_status_id' => '',
        'ms_user_id' => '',
        'date_kandidat' => '',
        'date_emp' => '',
        'date_hrd_approve' => '',
        'date_finance_approve' => '',
        'date_bod_approve' => '',
        'rating_hrd' => '',
        'rating_finance' => '',
        'rating_bod' => '',
        'rating_spv' => '',
        'date_spv' => '',
    ];

    public function mount($kandidat = null, $from_pelamar = false, $pelamar_id = null)
    {
        $this->kandidat = $kandidat;
        $this->from_pelamar = $from_pelamar;
        $this->pelamar_id = $pelamar_id;
        if ($kandidat) {
            $this->fields = $kandidat->toArray();
            $this->mode = 'edit';
        } elseif ($from_pelamar && $pelamar_id) {
            $this->fields['ms_hr_kandidat_emp_id'] = $pelamar_id;
            // TODO: Copy data pelamar ke kandidat jika perlu
        }
    }

    public function save()
    {
        $this->validate([
            'fields.ms_hr_kandidat_emp_id' => 'required',
        ]);
        if ($this->mode === 'edit') {
            $this->kandidat->update($this->fields);
        } else {
            MsHrKandidat::create($this->fields);
        }
        session()->flash('success', 'Data kandidat berhasil disimpan.');
        return redirect()->to('/kandidat');
    }

    public function render()
    {
        return view('livewire.kandidat-form');
    }
}
