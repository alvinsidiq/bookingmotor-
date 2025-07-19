<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MotorcycleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $motorcycles = Motorcycle::with(['category', 'brand'])->orderBy('name')->get();
        return view('admin.motorcycles.index', compact('motorcycles'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        return view('admin.motorcycles.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rental_rate' => 'required|numeric|min:0',
            'is_available' => 'sometimes|boolean', // ✅ fix here
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Motorcycle::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('motorcycles/images', 'public');
        }

        $validated['is_available'] = $request->boolean('is_available'); // ✅ ensure boolean

        Motorcycle::create($validated);

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle created successfully.');
    }

    public function edit(Motorcycle $motorcycle)
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        return view('admin.motorcycles.edit', compact('motorcycle', 'categories', 'brands'));
    }

    public function update(Request $request, Motorcycle $motorcycle)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rental_rate' => 'required|numeric|min:0',
            'is_available' => 'sometimes|boolean', // ✅ fix here
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Motorcycle::where('slug', $slug)->where('id', '!=', $motorcycle->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            if ($motorcycle->image && Storage::disk('public')->exists($motorcycle->image)) {
                Storage::disk('public')->delete($motorcycle->image);
            }
            $validated['image'] = $request->file('image')->store('motorcycles/images', 'public');
        }

        $validated['is_available'] = $request->boolean('is_available'); // ✅ ensure boolean

        $motorcycle->update($validated);

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle updated successfully.');
    }

    public function destroy(Motorcycle $motorcycle)
    {
        if ($motorcycle->image && Storage::disk('public')->exists($motorcycle->image)) {
            Storage::disk('public')->delete($motorcycle->image);
        }

        $motorcycle->delete();

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle deleted successfully.');
    }
}
