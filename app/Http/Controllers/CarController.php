<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
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
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'price' => 'required|numeric|min:0',
        ]);

        Car::create($validated);

        // Redirect back to list - SPA-style!
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
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'price' => 'required|numeric|min:0',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully!');
    }

    // DELETE (Remove car)
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully!');
    }
}
