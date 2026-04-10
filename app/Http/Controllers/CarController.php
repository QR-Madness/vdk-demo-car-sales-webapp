<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CarController extends Controller
{
    // READ (List all)
    public function index()
    {
        return Inertia::render('Cars/Index', [
            'cars' => Car::latest()->get(),
        ]);
    }

    // READ (Show single car)
    public function show(Car $car)
    {
        return Inertia::render('Cars/Show', [
            'car' => $car,
        ]);
    }

    // READ (Show form to create)
    public function create()
    {
        return Inertia::render('Cars/Create');
    }

    // CREATE (Store new car)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mileage' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:255',
            'horsepower' => 'nullable|integer|min:0',
            'transmission' => 'nullable|in:Automatic,Manual,CVT',
            'fuel_type' => 'nullable|in:Gasoline,Diesel,Electric,Hybrid',
            'condition' => 'nullable|in:New,Excellent,Good,Fair,Poor',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully!');
    }

    // READ (Show single car for editing)
    public function edit(Car $car)
    {
        return Inertia::render('Cars/Edit', [
            'car' => $car,
        ]);
    }

    // UPDATE (Save changes)
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
            'mileage' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:255',
            'horsepower' => 'nullable|integer|min:0',
            'transmission' => 'nullable|in:Automatic,Manual,CVT',
            'fuel_type' => 'nullable|in:Gasoline,Diesel,Electric,Hybrid',
            'condition' => 'nullable|in:New,Excellent,Good,Fair,Poor',
        ]);

        // Handle image: new upload takes priority, then explicit remove, otherwise keep existing
        if ($request->hasFile('image')) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = null;
        } else {
            // No new file and no remove request — keep the existing image untouched
            unset($validated['image']);
        }

        unset($validated['remove_image']);

        $car->update($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully!');
    }

    // DELETE (Remove car)
    public function destroy(Car $car)
    {
        // Delete image if exists
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully!');
    }
}
