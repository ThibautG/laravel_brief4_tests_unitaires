<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase;

class ProductControllerTest extends TestCase
{
    // Reset the database between each test
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();

        // Seed the database before each test
        $this->seed();

    }
    /**
     * A basic feature test example.
     */
    public function test_product_controller_list(): void
    {
        // check the status 200 on the /products route
        $response = $this->get('/products');
        $response->assertStatus(200);

        // check product listing
        $showProducts = Product::all();
        $this->assertDatabaseCount('products', count($showProducts));

    }

    public function test_product_controller_store()
    {
        // Simulate a user creating a new product through the web interface
        $response = $this->post(route('products.store'), [
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Assert that the post is successfully stored in the database
        $this->assertCount(1, Product::all());

        // Assert that the user is redirected to the Posts Index page after post creation
        $response->assertRedirect(route('products.index'));
    }
}
