<?php


use App\Containers\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProductCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_cannot_create_product(): void
    {
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'cost' => 100,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/products', $productData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'cost' => 100,
        ]);
    }
}
