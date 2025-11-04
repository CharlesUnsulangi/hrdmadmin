<?php

namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\MsHrBaKejadian;
use Illuminate\Support\Facades\Log;

class MsHrBaKejadianComponent extends Component
{
    public $ms_hr_ba_kejadian_desc, $edit_id = null;

    protected $rules = [
        'ms_hr_ba_kejadian_desc' => 'required|string|max:100',
    ];

    protected $messages = [
        'ms_hr_ba_kejadian_desc.required' => 'Deskripsi kejadian harus diisi',
        'ms_hr_ba_kejadian_desc.max' => 'Deskripsi kejadian maksimal 100 karakter',
    ];

    public function render()
    {
        $data = MsHrBaKejadian::orderBy('ms_hr_ba_kejadian_id', 'desc')->get();
        return view('livewire.master.ms-hr-ba-kejadian', compact('data'));
    }

    public function resetForm()
    {
        $this->ms_hr_ba_kejadian_desc = '';
        $this->edit_id = null;
        $this->resetValidation();
    }

    public function store()
    {
        try {
            $this->validate();

            // Check uniqueness manually
            $exists = MsHrBaKejadian::where('ms_hr_ba_kejadian_desc', $this->ms_hr_ba_kejadian_desc)->exists();
            if ($exists) {
                $this->addError('ms_hr_ba_kejadian_desc', 'Deskripsi kejadian sudah ada');
                return;
            }

            // Generate next ID
            $nextId = MsHrBaKejadian::max('ms_hr_ba_kejadian_id') + 1;

            MsHrBaKejadian::create([
                'ms_hr_ba_kejadian_id' => $nextId,
                'ms_hr_ba_kejadian_desc' => $this->ms_hr_ba_kejadian_desc,
            ]);

            $this->resetForm();
            session()->flash('success', 'Master BA Kejadian berhasil ditambahkan!');

        } catch (\Exception $e) {
            Log::error('Error creating Master BA Kejadian in Livewire', [
                'error' => $e->getMessage(),
                'desc' => $this->ms_hr_ba_kejadian_desc
            ]);
            session()->flash('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = MsHrBaKejadian::findOrFail($id);
        $this->edit_id = $id;
        $this->ms_hr_ba_kejadian_desc = $data->ms_hr_ba_kejadian_desc;
    }

    public function update()
    {
        try {
            $this->validate();

            // Check uniqueness manually (exclude current record)
            $exists = MsHrBaKejadian::where('ms_hr_ba_kejadian_desc', $this->ms_hr_ba_kejadian_desc)
                ->where('ms_hr_ba_kejadian_id', '!=', $this->edit_id)
                ->exists();
            
            if ($exists) {
                $this->addError('ms_hr_ba_kejadian_desc', 'Deskripsi kejadian sudah ada');
                return;
            }

            $data = MsHrBaKejadian::findOrFail($this->edit_id);
            $data->update([
                'ms_hr_ba_kejadian_desc' => $this->ms_hr_ba_kejadian_desc,
            ]);

            $this->resetForm();
            session()->flash('success', 'Master BA Kejadian berhasil diupdate!');

        } catch (\Exception $e) {
            Log::error('Error updating Master BA Kejadian in Livewire', [
                'id' => $this->edit_id,
                'error' => $e->getMessage(),
                'desc' => $this->ms_hr_ba_kejadian_desc
            ]);
            session()->flash('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = MsHrBaKejadian::findOrFail($id);
            $data->delete();
            session()->flash('success', 'Master BA Kejadian berhasil dihapus!');

        } catch (\Exception $e) {
            Log::error('Error deleting Master BA Kejadian in Livewire', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}