<?php

namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\MsHrFrom as MsHrFromModel;

class MsHrFrom extends Component
{
    public $ms_hr_from_id, $form_hr_desc, $edit_id = null;

    protected $rules = [
        'ms_hr_from_id' => 'required|string|max:50|unique:ms_hr_from,ms_hr_from_id',
        'form_hr_desc' => 'nullable|string|max:50',
    ];

    public function render()
    {
        $data = MsHrFromModel::orderBy('ms_hr_from_id', 'asc')->get();
        return view('livewire.master.ms-hr-from', compact('data'));
    }

    public function resetForm()
    {
        $this->ms_hr_from_id = '';
        $this->form_hr_desc = '';
        $this->edit_id = null;
    }

    public function store()
    {
        $this->validate();
        MsHrFromModel::create([
            'ms_hr_from_id' => $this->ms_hr_from_id,
            'form_hr_desc' => $this->form_hr_desc,
        ]);
        $this->resetForm();
        session()->flash('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $row = MsHrFromModel::findOrFail($id);
        $this->ms_hr_from_id = $row->ms_hr_from_id;
        $this->form_hr_desc = $row->form_hr_desc;
        $this->edit_id = $id;
    }

    public function update()
    {
        $this->validate([
            'form_hr_desc' => 'nullable|string|max:50',
        ]);
        $row = MsHrFromModel::findOrFail($this->edit_id);
        $row->update([
            'form_hr_desc' => $this->form_hr_desc,
        ]);
        $this->resetForm();
        session()->flash('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $row = MsHrFromModel::findOrFail($id);
        $row->delete();
        session()->flash('success', 'Data berhasil dihapus!');
    }
}
