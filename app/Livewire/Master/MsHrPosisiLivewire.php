<?php

namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\MsHrPosisi;


class MsHrPosisiLivewire extends Component
{
    public $ms_hr_posisi_id, $posisi_desc, $edit_id = null;

    public function render()
    {
        $data = MsHrPosisi::orderBy('ms_hr_posisi_id', 'asc')->get();
        return view('livewire.master.ms-hr-posisi', compact('data'));
    }

    public function resetForm()
    {
        $this->ms_hr_posisi_id = '';
        $this->posisi_desc = '';
        $this->edit_id = null;
    }

    public function store()
    {
        $this->validate([
            'ms_hr_posisi_id' => 'required|string|max:50|unique:ms_hr_posisi,ms_hr_posisi_id',
            'posisi_desc' => 'nullable|string|max:50',
        ]);
        MsHrPosisi::create([
            'ms_hr_posisi_id' => $this->ms_hr_posisi_id,
            'posisi_desc' => $this->posisi_desc,
        ]);
        $this->resetForm();
        session()->flash('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $row = MsHrPosisi::findOrFail($id);
        $this->edit_id = $row->ms_hr_posisi_id;
        $this->ms_hr_posisi_id = $row->ms_hr_posisi_id;
        $this->posisi_desc = $row->posisi_desc;
    }

    public function update()
    {
        $this->validate([
            'posisi_desc' => 'nullable|string|max:50',
        ]);
        $row = MsHrPosisi::findOrFail($this->edit_id);
        $row->update([
            'posisi_desc' => $this->posisi_desc,
        ]);
        $this->resetForm();
        session()->flash('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $row = MsHrPosisi::findOrFail($id);
        $row->delete();
        session()->flash('success', 'Data berhasil dihapus!');
    }
}
