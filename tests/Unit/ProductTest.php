<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Illuminate\Foundation\Testing\TestCase;

class ProductTest extends TestCase
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
     * A basic unit test example.
     */
    public function test_attributes_are_set_correctly(): void
    {
        // create a new product instance with attributes
       $product = new Product([
           'name' => 'Sample Product Name',
           'description' => 'Sample Product Description',
           'price' => 65.99,
           'stock' => 15,
       ]);

       // check if you set the attributes correctly
       $this->assertEquals('Sample Product Name', $product->name);
       $this->assertEquals('Sample Product Description', $product->description);
       $this->assertEquals(65.99, $product->price);
       $this->assertEquals(15, $product->stock);
    }

    public function test_non_fillable_attributes_are_not_set(): void
    {
        // Attempt to create a product with additional attributes (non-fillable)
        $product = new Product([
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
            'store' => 'Apple',
        ]);

        // check that the non-fillable attribute is not set on the product
        // instance
        $this->assertArrayNotHasKey('store', $product->getAttributes());
    }

    public function test_product_store()
    {
        // Create a new product and save it to the database
        $product = Product::create([
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Retrieve the product from the database and assert its existence
        $createdProduct = Product::find($product->id);
        $this->assertNotNull($createdProduct);
        $this->assertEquals('Sample Product Name', $createdProduct->name);
        $this->assertEquals('Sample Product Description',
            $createdProduct->description);
        $this->assertEquals(65.99, $createdProduct->price);
        $this->assertEquals(15, $createdProduct->stock);
    }

    public function test_product_update()
    {
        // Create a new product and save it to the database
        $product = Product::create([
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Retrieve the product from the database, update its data and verify
        // if the new product in the DB has the given properties
        $createdProduct = Product::find($product->id);
        $createdProduct->update([
            'name' => 'Updated Product Name',
            'description' => 'Updated Product Description',
            'price' => 665.99,
            'stock' => 2,
        ]);
        $this->assertNotNull($createdProduct);
        $this->assertEquals('Updated Product Name', $createdProduct->name);
        $this->assertEquals('Updated Product Description',
            $createdProduct->description);
        $this->assertEquals(665.99, $createdProduct->price);
        $this->assertEquals(2, $createdProduct->stock);
    }

    public function test_product_destroy()
    {
        // Create a new product and save it to the database
        $product = Product::create([
            'name' => 'Sample Product Name',
            'description' => 'Sample Product Description',
            'price' => 65.99,
            'stock' => 15,
        ]);

        // Retrieve the product from the database, delete it and check if
        // it's missing from the database
        $createdProduct = Product::find($product->id);
        $createdProductId = $createdProduct->id;
        $createdProduct->delete();
        $this->assertDatabaseMissing('products', [
            'id' => $createdProductId
        ]);
    }
}
