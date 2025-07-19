<?php
namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $icon, $image, $is_active = false, $sort_order = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon' => 'nullable|image|max:1024',
        'image' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
        'sort_order' => 'nullable|integer',
    ];

   public function save()
{
    $data = $this->validate();

    $data['slug'] = Str::slug($this->name);

    if ($this->icon) {
        $data['icon'] = $this->icon->store('categories/icons', 'public');
    }

    if ($this->image) {
        $data['image'] = $this->image->store('categories/images', 'public');
    }

    Category::create($data);

    session()->flash('success', 'Category created successfully.');

    return redirect()->route('admin.categories.index');
}

    public function render()
    {
        return view('livewire.admin.categories.create')->layout('layouts.admin');
    }
}
