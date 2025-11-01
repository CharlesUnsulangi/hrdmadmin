<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarSosmed;

class PelamarSosmed extends Component
{
    public $pelamarId;
    public $sosmedList = [];
    public $showForm = false;
    public $editId = null;
    public $form = [
        'sosmed_link' => '',
    ];

    public function mount($pelamarId)
    {
        $this->pelamarId = $pelamarId;
        $this->loadSosmed();
    }

    public function loadSosmed()
    {
        $this->sosmedList = TrHrPelamarSosmed::where('tr_hr_pelamar_id', $this->pelamarId)->get();
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editId = null;
    }

    public function showEditForm($id)
    {
        $sosmed = TrHrPelamarSosmed::findOrFail($id);
        $this->form = [
            'sosmed_link' => $sosmed->sosmed_link,
        ];
        $this->showForm = true;
        $this->editId = $id;
    }

    public function saveSosmed()
    {
        $data = $this->validate([
            'form.sosmed_link' => 'required|string|max:255',
        ])['form'];
        $data['tr_hr_pelamar_id'] = $this->pelamarId;
        if ($this->editId) {
            $sosmed = TrHrPelamarSosmed::findOrFail($this->editId);
            $sosmed->update($data);
        } else {
            TrHrPelamarSosmed::create($data);
        }
        $this->showForm = false;
        $this->editId = null;
        $this->resetForm();
        $this->loadSosmed();
    }

    public function deleteSosmed($id)
    {
        $sosmed = TrHrPelamarSosmed::findOrFail($id);
        $sosmed->delete();
        $this->loadSosmed();
    }

    public function resetForm()
    {
        $this->form = [
            'sosmed_link' => '',
        ];
    }

    public function render()
    {
        return view('livewire.pelamar-sosmed');
    }
}
