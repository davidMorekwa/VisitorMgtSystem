<?php

namespace App\Livewire\Dashboard;

use App\Models\Visit;
use Livewire\Component;

class Dashboard extends Component
{

    private function getTypesOfComplaints(){
        $complaints = Visit::all(['purpose_of_visit']);
        // dd($complaints->uniqueStrict('purpose_of_visit'));
        return $complaints->uniqueStrict('purpose_of_visit');
    }

    public function render()
    {
        $complaints = $this->getTypesOfComplaints();
        return view('livewire.dashboard.dashboard')
            ->with('complaints', $complaints)
            ->layout('layouts.app');
    }
}
