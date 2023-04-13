<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create()
        );

        $this->artisan('db:seed');
    }

    public function test_it_retrieves_products(): void
    {
        $response = $this->getJson(route('api.products.index'));

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 100);
    }

    public function test_it_retrieve_a_specific_product(): void
    {
        $product = Product::first();

        $response = $this->getJson(route('api.products.show', $product->id));

        $response->assertStatus(200);
    }

    public function test_it_creates_a_new_product(): void
    {
        $categoriesIds = Category::pluck('id');

        $response = $this->postJson(
            route('api.products.store', [
                'name' => 'product A',
                'description' => 'A brand new product named A',
                'stock' => 5,
                'price' => 2.22,
                'categories[0]' => $categoriesIds[0],
                'categories[1]' => $categoriesIds[1],
            ])
        );

        $response->assertStatus(200);
    }

    public function test_it_updates_a_product(): void
    {
        $product = Product::first();

        $response = $this->putJson(route('api.products.update', $product->id), [
            'name' => 'updated product',
            'description' => 'updated description',
            'stock' => 2,
            'price' => 22.33
        ]);

        $response->assertStatus(200);
    }

    public function test_it_deletes_a_product(): void
    {
        $total = Product::count();

        $product = Product::first();

        $response = $this->deleteJson(route('api.products.destroy', $product->id));

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', $total - 1);
    }
}
