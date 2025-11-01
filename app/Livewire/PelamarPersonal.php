<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarPersonal;

class PelamarPersonal extends Component
{
    public $pelamarId;
    public $personal;
    public $form = [
        'nama' => '',
        'nama_keluarga' => '',
        'date_lahir' => '',
        'kota_lahir' => '',
        'alamat' => '',
        'jenis' => '',
        'agama' => '',
        'pendidikan' => '',
        'cek_pengalaman' => false,
        'gaji_diminta' => '',
    ];
    public $showForm = false;

    public function mount($pelamarId)
    {
        $this->pelamarId = $pelamarId;
        $this->loadPersonal();
    }

    public function loadPersonal()
    {
        $this->personal = TrHrPelamarPersonal::where('tr_hr_pelamar_id', $this->pelamarId)->first();
        if ($this->personal) {
            $this->form = [
                'nama' => $this->personal->nama,
                'nama_keluarga' => $this->personal->nama_keluarga,
                'date_lahir' => $this->personal->date_lahir,
                'kota_lahir' => $this->personal->kota_lahir,
                'alamat' => $this->personal->alamat,
                'jenis' => $this->personal->jenis,
                'agama' => $this->personal->agama,
                'pendidikan' => $this->personal->pendidikan,
                'cek_pengalaman' => $this->personal->cek_pengalaman,
                'gaji_diminta' => $this->personal->gaji_diminta,
            ];
        }
    }

    public function showEditForm()
    {
        $this->showForm = true;
    }

    public function savePersonal()
    {
        $data = $this->validate([
            'form.nama' => 'required|string|max:50',
            'form.nama_keluarga' => 'nullable|string|max:10',
            'form.date_lahir' => 'nullable|date',
            'form.kota_lahir' => 'nullable|string|max:50',
            'form.alamat' => 'nullable|string|max:50',
            'form.jenis' => 'nullable|string|max:50',
            'form.agama' => 'nullable|string|max:50',
            'form.pendidikan' => 'nullable|string|max:50',
            'form.cek_pengalaman' => 'nullable|boolean',
            'form.gaji_diminta' => 'nullable|numeric',
        ])['form'];
        $data['tr_hr_pelamar_id'] = $this->pelamarId;
        if ($this->personal) {
            $this->personal->update($data);
        } else {
            TrHrPelamarPersonal::create($data);
        }
        $this->showForm = false;
        $this->loadPersonal();
    }

    public function render()
    {
        return view('livewire.pelamar-personal');
    }
}
