<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Products;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_products()
    {
        Products::factory()->count(5)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(5, $response);
        $response->assertJson(['data' => $response]);
    }



    public function test_can_show_product()
    {
        $product = Products::factory()->create();

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson(['data' => $product]);
    }



    public function test_can_create_product()
    {
        $productData = [
            'name' => 'Product 1',
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201);
        $response->assertJson(['data' => $productData]);
    }



    public function test_can_update_product()
    {
        $product = Products::factory()->create();

        $updateData = [
            'name' => 'Updated Product Name'
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updateData);

        $response->assertStatus(200);
        $response->assertJson(['data' => $updateData]);
    }



    public function test_can_delete_product()
    {
        $product = Products::factory()->create();

        $response = $this->delete("/api/products/{$product->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
