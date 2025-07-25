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
        // Store DB length in a variable
        $productsCount = count(Product::all());
        // Simulate a user creating a new product through the web interface
        $response = $this->post(route('products.store'), [
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Assert that the post is successfully stored in the database
        $this->assertCount($productsCount + 1, Product::all());

        // Assert that the user is redirected to the products index page after
        // product creation
        $response->assertRedirect(route('products.index'));
    }

    public function test_product_controller_store_validation_error()
    {
        // Simulate a user creating a new product with a blank name
        $response = $this->post(route('products.store'), [
            'name' => '',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // check if there is an error
        $response->assertSessionHasErrors();
    }

    public function test_product_controller_update()
    {
        // Simulate a user creating a new product through the web interface
        $this->post(route('products.store'), [
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Retrieve ID from new product
        $productId = Product::latest()->first()->id;

        // update the product with new infos
        $response = $this->put(route('products.update', $productId), [
            'name' => 'Updated Product Name',
            'description' => 'Updated Product Description',
            'price' => 665.99,
            'stock' => 2,
        ]);

        // Assert that the user is redirected to the products index page after
        // product update
        $response->assertRedirect(route('products.index'));

        // Assert that updated datas are in the DB
        $this->assertDatabaseHas('products', [
            'id' => $productId,
            'name' => 'Updated Product Name',
            'description' => 'Updated Product Description',
            'price' => 665.99,
            'stock' => 2,
        ]);
    }

    public function test_product_controller_destroy()
    {
        // Simulate a user creating a new product through the web interface
        $this->post(route('products.store'), [
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Retrieve ID from new product
        $product = Product::latest()->first();

        // update the product with new infos
        $response = $this->delete(route('products.destroy', $product));

        // Assert that the user is redirected to the products index page after
        // product delete
        $response->assertRedirect(route('products.index'));

        // Assert that product is not displayed
        $response->assertDontSee('Sample Product Name');

    }
}
