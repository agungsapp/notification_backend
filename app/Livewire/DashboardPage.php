<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class DashboardPage extends Component
{

    public $stats;

    public function mount()
    {

        $users = User::query()
            ->selectRaw("COUNT(CASE WHEN position = 'hrd' THEN 1 END) AS hrd")
            ->selectRaw("COUNT(CASE WHEN position = 'manager' THEN 1 END) AS manager")
            ->selectRaw("COUNT(CASE WHEN position = 'pic' THEN 1 END) AS pic")
            ->selectRaw("COUNT(CASE WHEN position = 'staff' THEN 1 END) AS staff")
            ->first();

        $this->stats = $users->toArray();

        // dd($this->stats);
    }

    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
