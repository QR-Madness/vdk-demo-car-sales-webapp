<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CarSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the cars directory exists in storage
        $storagePath = storage_path('app/public/cars');
        if (! File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Copy images from seeder directory to storage
        $imagesSourcePath = database_path('seeders/images');
        $images = [
            'f150-raptor.jpg',
            'mercedes-benz-s-class.jpg',
        ];

        foreach ($images as $image) {
            $sourcePath = $imagesSourcePath.'/'.$image;
            $destPath = $storagePath.'/'.$image;

            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $destPath);
            }
        }

        $cars = [
            [
                'make' => 'Ford',
                'model' => 'F-150 Raptor',
                'year' => 2023,
                'price' => 78950.00,
                'image' => 'cars/f150-raptor.jpg',
                'mileage' => 12500,
                'color' => 'Agate Black',
                'horsepower' => 450,
                'transmission' => 'Automatic',
                'fuel_type' => 'Gasoline',
                'condition' => 'Excellent',
            ],
            [
                'make' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'year' => 2024,
                'price' => 125000.00,
                'image' => 'cars/mercedes-benz-s-class.jpg',
                'mileage' => 3500,
                'color' => 'Obsidian Black',
                'horsepower' => 496,
                'transmission' => 'Automatic',
                'fuel_type' => 'Gasoline',
                'condition' => 'Excellent',
            ],
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }
    }
}
