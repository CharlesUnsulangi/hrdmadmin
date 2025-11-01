<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MsHrKandidat;

class KandidatTable extends Component
{
    public $search = '';
    public $status = '';

    public function render()
    {
        $query = MsHrKandidat::query();
        if ($this->search) {
            $query->where('ms_hr_kandidat_emp_id', 'like', '%'.$this->search.'%');
        }
        if ($this->status) {
            $query->where('ms_status_id', $this->status);
        }
        $kandidat = $query->orderByDesc('created_at')->paginate(15);
        // Kirim variabel secara eksplisit
        return view('livewire.kandidat-table')->with(['kandidat' => $kandidat]);
    }
}
