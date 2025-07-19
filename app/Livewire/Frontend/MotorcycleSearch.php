<?php
namespace App\Livewire\Frontend;

use App\Models\Motorcycle;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Location;
use Livewire\Component;

class MotorcycleSearch extends Component
{
    public $category_id = '';
    public $brand_id = '';
    public $location_id = '';

    public function render()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();

        $query = Motorcycle::where('is_available', true)->with(['category', 'brand']);

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }
        if ($this->brand_id) {
            $query->where('brand_id', $this->brand_id);
        }

        $motorcycles = $query->get();

        return view('livewire.frontend.motorcycle-search', compact('motorcycles', 'categories', 'brands', 'locations'))
            ->layout('layouts.frontend');
    }
}