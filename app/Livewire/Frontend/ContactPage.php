<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactPage extends Component
{
    public $name;
    public $email;
    public $message;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function send()
    {
        $this->validate();

        // Simulasi pengiriman (nanti bisa dihubungkan ke Mail atau disimpan ke DB)
        // Contoh Mail::to('admin@example.com')->send(new ContactMessage(...))

        $this->reset(['name', 'email', 'message']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.frontend.contact-page')->layout('layouts.frontend');
    }
}
