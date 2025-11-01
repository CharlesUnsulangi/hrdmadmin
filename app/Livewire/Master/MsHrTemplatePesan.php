<?php

namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\MsHrWaMsg;

class MsHrTemplatePesan extends Component
{
    public $msg_code, $msg_text, $edit_id = null;

    protected $rules = [
        'msg_code' => 'required|string|max:50|unique:ms_hr_wa_msg,msg_code',
        'msg_text' => 'required|string|max:255',
    ];

    public function render()
    {
        $data = MsHrWaMsg::orderBy('id', 'asc')->get();
        return view('livewire.master.ms-hr-template-pesan', compact('data'));
    }

    public function resetForm()
    {
        $this->msg_code = '';
        $this->msg_text = '';
        $this->edit_id = null;
    }

    public function store()
    {
        $this->validate();
        MsHrWaMsg::create([
            'msg_code' => $this->msg_code,
            'msg_text' => $this->msg_text,
        ]);
        $this->resetForm();
        session()->flash('success', 'Template berhasil ditambah!');
    }

    public function edit($id)
    {
        $row = MsHrWaMsg::findOrFail($id);
        $this->msg_code = $row->msg_code;
        $this->msg_text = $row->msg_text;
        $this->edit_id = $id;
    }

    public function update()
    {
        $this->validate([
            'msg_text' => 'required|string|max:255',
        ]);
        $row = MsHrWaMsg::findOrFail($this->edit_id);
        $row->update([
            'msg_text' => $this->msg_text,
        ]);
        $this->resetForm();
        session()->flash('success', 'Template berhasil diupdate!');
    }

    public function destroy($id)
    {
        $row = MsHrWaMsg::findOrFail($id);
        $row->delete();
        session()->flash('success', 'Template berhasil dihapus!');
    }
}
