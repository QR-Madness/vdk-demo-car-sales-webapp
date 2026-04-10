<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CarListingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public can view car listings.
     */
    public function test_public_can_view_car_listings(): void
    {
        Car::factory()->count(3)->create();

        $response = $this->get('/cars');

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page->has('cars', 3));
    }

    /**
     * Test public can view single car details.
     */
    public function test_public_can_view_single_car(): void
    {
        $car = Car::factory()->create();

        $response = $this->get("/cars/{$car->id}");

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page->has('car'));
    }

    /**
     * Test guest cannot access create form.
     */
    public function test_guest_cannot_access_create_form(): void
    {
        $response = $this->get('/cars/create');

        $response->assertRedirect('/login');
    }

    /**
     * Test guest cannot store car.
     */
    public function test_guest_cannot_store_car(): void
    {
        $response = $this->post('/cars', [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2023,
            'price' => 25000,
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseCount('cars', 0);
    }

    /**
     * Test authenticated user can access create form.
     */
    public function test_authenticated_user_can_access_create_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cars/create');

        $response->assertStatus(200);
    }

    /**
     * Test authenticated user can create car.
     */
    public function test_authenticated_user_can_create_car(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        $response = $this->actingAs($user)->post('/cars', [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2023,
            'price' => 25000,
            'mileage' => 50000,
            'color' => 'Red',
            'horsepower' => 200,
            'transmission' => 'Automatic',
            'fuel_type' => 'Gasoline',
            'condition' => 'Good',
        ]);

        $response->assertRedirect('/cars');
        $this->assertDatabaseHas('cars', [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2023,
        ]);
    }

    /**
     * Test authenticated user can create car with image.
     */
    public function test_authenticated_user_can_create_car_with_image(): void
    {
        $user = User::factory()->create();
        Storage::fake('public');

        $file = UploadedFile::fake()->image('car.jpg');

        $response = $this->actingAs($user)->post('/cars', [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2023,
            'price' => 25000,
            'image' => $file,
        ]);

        $response->assertRedirect('/cars');

        $car = Car::first();
        $this->assertNotNull($car->image);
        $this->assertTrue(Storage::disk('public')->exists($car->image));
    }

    /**
     * Test car validation errors.
     */
    public function test_car_validation_errors(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/cars', [
            'make' => '',
            'model' => '',
            'year' => 'invalid',
            'price' => -100,
        ]);

        $response->assertSessionHasErrors(['make', 'model', 'year', 'price']);
    }

    /**
     * Test guest cannot access edit form.
     */
    public function test_guest_cannot_access_edit_form(): void
    {
        $car = Car::factory()->create();

        $response = $this->get("/cars/{$car->id}/edit");

        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated user can access edit form.
     */
    public function test_authenticated_user_can_access_edit_form(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->actingAs($user)->get("/cars/{$car->id}/edit");

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page->has('car'));
    }

    /**
     * Test authenticated user can update car.
     */
    public function test_authenticated_user_can_update_car(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create([
            'make' => 'Honda',
            'model' => 'Civic',
        ]);

        $response = $this->actingAs($user)->put("/cars/{$car->id}", [
            'make' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2022,
            'price' => 20000,
        ]);

        $response->assertRedirect('/cars');
        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'make' => 'Toyota',
            'model' => 'Corolla',
        ]);
    }

    /**
     * Test guest cannot delete car.
     */
    public function test_guest_cannot_delete_car(): void
    {
        $car = Car::factory()->create();

        $response = $this->delete("/cars/{$car->id}");

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('cars', ['id' => $car->id]);
    }

    /**
     * Test authenticated user can delete car.
     */
    public function test_authenticated_user_can_delete_car(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->actingAs($user)->delete("/cars/{$car->id}");

        $response->assertRedirect('/cars');
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}
