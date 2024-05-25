<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
  Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);

  $user = User::find(1);
  Sanctum::actingAs($user);
});


test('get products', function () {
    Product::factory()->count(4)->create();

    $this->get('/api/products')->assertOk()->assertJsonCount(4, 'data')->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'description',
                'price',
                'stock',
                'sale_price',
                'category_id',
            ],
        ],
    ]);
});

test('create product', function () {
  $product = Product::factory()->raw();

  $this->postJson('api/products', $product)->assertCreated();

  $this->assertDatabaseHas('products', [
    'name' => $product['name'],
    'description' => $product['description'],
    'price' => $product['price'],
    'stock' => $product['stock'],
    'sale_price' => $product['sale_price'],
    'category_id' => $product['category_id'],
  ]);
});

test('get product', function () {
  $product = Product::factory()->create();

  $this->getJson("api/products/{$product->id}")->assertOk();
});

test('update product', function () {
  $product = Product::factory()->create();

  $newProduct = Product::factory()->raw();

  $this->putJson("api/products/{$product->id}", $newProduct)->assertOk();

  $this->assertDatabaseHas('products', [
      'id' => $product->id,
      'name' => $newProduct['name'],
      'updated_at' => $newProduct['updated_at'],
  ]);
});

test('delete Product', function () {
  $product = Product::factory()->create();

  $this->deleteJson('api/products/'.$product->id)->assertStatus(200);

  $this->assertDeleted($product);
});
