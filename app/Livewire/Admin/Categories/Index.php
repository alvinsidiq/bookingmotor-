<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::orderBy('sort_order')->get();
    }

    public function delete($id)
{
    $category = Category::findOrFail($id);

    // Hapus file icon & image jika ada
    if ($category->icon && \Storage::disk('public')->exists($category->icon)) {
        \Storage::disk('public')->delete($category->icon);
    }
    if ($category->image && \Storage::disk('public')->exists($category->image)) {
        \Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    session()->flash('success', 'Category deleted successfully.');
}

    public function render()
    {

        $categories = Category::orderBy('sort_order')->get();


          return view('livewire.admin.categories.index', [
            'categories' => $categories
        ])->layout('layouts.admin');
    }
}
