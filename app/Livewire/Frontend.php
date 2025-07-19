<?php

namespace App\Livewire;

use Livewire\Component;

class Frontend extends Component
{
    public function render()
    {
        return view('livewire.frontend')
            ->layout('layouts.frontend'); // Gunakan layout yang kamu buat
    }
}
