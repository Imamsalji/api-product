<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private function auth()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        return ["Authorization" => "Bearer $token"];
    }

    /** @test */
    public function api_create_product()
    {
        $response = $this->withHeaders($this->auth())
            ->postJson('/api/product', [
                'name' => 'Laptop',
                'sku' => 'skulaptop',
                'quantity' => 10,
                'price' => 10000
            ]);
        $response->dump();
        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    /** @test */
    public function api_list_products()
    {
        Product::factory()->create();

        $response = $this->withHeaders($this->auth())
            ->getJson('/api/product');

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }


    /** @test */
    public function api_update_product()
    {
        $product = Product::factory()->create();

        $response = $this->withHeaders($this->auth())
            ->putJson("/api/product/{$product->id}", [
                'name' => 'Laptop Baru',
                'sku' => 'skulaptop',
                'quantity' => 10,
                'price' => 10000
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Transaksi berhasil']);
    }

    /** @test */
    public function api_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->withHeaders($this->auth())
            ->deleteJson("/api/product/{$product->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
