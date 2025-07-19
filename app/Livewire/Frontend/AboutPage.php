<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.about-page')
            ->layout('layouts.frontend'); // Pakai layout utama
    }
}
