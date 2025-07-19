<?php
namespace App\Http\Controllers;

use App\Models\Promocode;
use App\Models\Category;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $promocodes = Promocode::with('category')->orderBy('valid_from', 'desc')->get();
        return view('admin.promocodes.index', compact('promocodes'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.promocodes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50|unique:promocodes,code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'max_usage' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        Promocode::create($validated);

        return redirect()->route('admin.promocodes.index')->with('success', 'Promocode created successfully.');
    }

    public function edit(Promocode $promocode)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.promocodes.edit', compact('promocode', 'categories'));
    }

    public function update(Request $request, Promocode $promocode)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50|unique:promocodes,code,' . $promocode->id,
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'max_usage' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $promocode->update($validated);

        return redirect()->route('admin.promocodes.index')->with('success', 'Promocode updated successfully.');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocodes.index')->with('success', 'Promocode deleted successfully.');
    }
}
