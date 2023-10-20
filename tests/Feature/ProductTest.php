<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    public function test_can_list_products(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }


    public function test_can_show_product(): void
    {
        $response = $this->get('/api/products/');

        $response->assertStatus(200);
    }


    public function test_can_create_product(): void
    {
        $response = $this->post('/api/products');

        $response->assertStatus(200);
    }


    public function test_can_update_product(): void
    {
        $response = $this->put('/api/products/');

        $response->assertStatus(200);
    }


    public function test_can_delete_product(): void
    {
        $response = $this->get('/api/products/');

        $response->assertStatus(200);
    }
}
