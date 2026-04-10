<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarListingsTest extends TestCase
{
    /**
     * Ensure that the car listings page returns a successful response + data.
     */
    public function test_get_cars(): void
    {
        $response = $this->get('/cars');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'make',
                'model',
                'year',
                'price',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
