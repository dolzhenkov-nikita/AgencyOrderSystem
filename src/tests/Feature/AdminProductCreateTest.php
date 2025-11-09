<?php

namespace Tests\Feature;

use App\Containers\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->admin()->create();

        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'cost' => 100,
        ];

        $response = $this->actingAs($admin)
            ->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'cost',
                    'description',
                    'created_at',
                    'updated_at'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Test Product',
                    'description' => 'Test Product Description',
                    'cost' => 100,
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'cost' => 100,
        ]);
    }
}
