<?php

namespace App\Livewire\Frontend;

use App\Models\Motorcycle;
use App\Models\Category;
use Livewire\Component;

class HomePage extends Component
{
    public $motorcycles;
    public $reviews;
    public $categories;
    public $totalMotorcycles;

    public function mount()
    {
        // Ambil motor yang tersedia (bukan 'is_active', karena kolom tersebut tidak ada)
        $this->motorcycles = Motorcycle::where('is_available', true)
            ->with(['category', 'brand'])
            ->latest()
            ->take(3)
            ->get();

        // Ambil kategori yang memiliki motor
        $this->categories = Category::has('motorcycles')->take(6)->get();

        // Hitung total motor yang tersedia
        $this->totalMotorcycles = Motorcycle::where('is_available', true)->count();

        // Dummy data ulasan pelanggan
        $this->reviews = [
            [
                'name' => 'John Doe',
                'rating' => 5,
                'comment' => 'Amazing experience! The motorcycle was in great condition, and the booking process was super easy.',
                'date' => '2025-07-10',
            ],
            [
                'name' => 'Jane Smith',
                'rating' => 4,
                'comment' => 'Customer service was helpful, but delivery took a bit longer than expected.',
                'date' => '2025-07-08',
            ],
            [
                'name' => 'Mike Johnson',
                'rating' => 5,
                'comment' => 'Best rental service! Affordable prices and a wide variety of bikes.',
                'date' => '2025-07-05',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.frontend.home-page')
            ->layout('layouts.frontend');
    }
}
