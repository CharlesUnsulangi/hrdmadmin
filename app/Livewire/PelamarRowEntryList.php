<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\TrHrPelamarMain;
use App\Models\MsHrFrom;

class PelamarRowEntryList extends Component
{
    public $rows = [];
    public $asal_lamaran_options = [];

    public function mount()
    {
        $this->asal_lamaran_options = MsHrFrom::pluck('form_hr_desc', 'ms_hr_from_id')->toArray();
        $this->addRow();
    }

    public function addRow()
    {
        $this->rows[] = [
            'nama' => '',
            'email' => '',
            'no_hp' => '',
            'ms_hr_from_id' => '',
            'rating' => '',
            'status' => '',
        ];
    }

    public function confirmSaveRow($index)
    {
        $this->dispatchBrowserEvent('swal:confirm-save-row', [
            'idx' => $index,
            'componentId' => $this->id,
        ]);
    }

    public function saveRow($index)
    {
        $data = $this->rows[$index];
        $validated = $this->validate([
            'rows.'.$index.'.nama' => 'required|string|max:50',
            'rows.'.$index.'.email' => ['required','email','max:50','regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'rows.'.$index.'.no_hp' => ['required','string','max:50','regex:/^62[0-9]{7,}$/'],
            'rows.'.$index.'.ms_hr_from_id' => 'nullable|string|max:50',
            'rows.'.$index.'.rating' => 'nullable|integer|min:0|max:5',
            'rows.'.$index.'.status' => 'nullable|string|max:50',
        ])['rows'][$index];
        // Auto prepend 62 jika belum ada
        if (!preg_match('/^62/', $validated['no_hp'])) {
            $validated['no_hp'] = '62' . ltrim($validated['no_hp'], '0');
        }
        $validated['tr_hr_pelamar_main_id'] = $validated['email'];
        $validated['date_created'] = now();
        $validated['cek_shortlist'] = true;
        $validated['cek_staff'] = true;
        $validated['cek_driver'] = false;
        $validated['cek_helper'] = false;
        TrHrPelamarMain::create($validated);
        $this->rows[$index]['saved'] = true;
        $this->addRow();
        session()->flash('success', 'Pelamar berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.pelamar-row-entry-list', [
            'asal_lamaran_options' => $this->asal_lamaran_options,
        ]);
    }
}
