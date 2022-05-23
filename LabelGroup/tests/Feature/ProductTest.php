<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowProducts()
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $response = $this->post('/product/create', ['name' => 'Computer', 'category_id' => 5, 'main_category_id' => 5]);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        $response = $this->delete('/product/delete/4');

        $response->assertStatus(200);
    }
}
