<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public Category $category;
    public $name, $description, $icon, $image, $is_active, $sort_order;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->is_active = $category->is_active;
        $this->sort_order = $category->sort_order;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:1024',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->category->name = $this->name;
        $this->category->description = $this->description;
        $this->category->slug = Str::slug($this->name);
        $this->category->is_active = $this->is_active ?? false;
        $this->category->sort_order = $this->sort_order;

        if ($this->icon) {
            $this->category->icon = $this->icon->store('categories/icons', 'public');
        }

        if ($this->image) {
            $this->category->image = $this->image->store('categories/images', 'public');
        }

        $this->category->save();

        session()->flash('success', 'Category updated successfully.');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.edit')->layout('layouts.admin');
    }
}
