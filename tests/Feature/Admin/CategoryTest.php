<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
  Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);

  $user = User::find(1);
  Sanctum::actingAs($user);
});


test('get categories', function () {
  $items = Category::factory()->count(4)->create();

  $this->get('/api/categories')->assertOk()->assertJsonCount(4, 'data')->assertJsonStructure([
    'data' => [
        '*' => [
            'id',
            'name',
            'image',
            'parent_id',
            'created_at',`
        ],
    ],
]);
});

test('create category', function () {
  $category = Category::factory()->raw();

  $this->postJson('api/categories', $category)->assertCreated();

  $this->assertDatabaseHas('categories', [
    'name' => $category['name'],
    '_lft' => $category['_lft'],
    '_rgt' => $category['_rgt'],
    'parent_id' => $category['parent_id'],
  ]);
});

test('get category', function () {
  $category = Category::factory()->create();

  $this->getJson("api/categories/{$category->id}")->assertOk();
});

test('update category', function () {
  // $category = Category::factory()->create();

  // $newCategory = Category::factory()->raw();

  // $this->putJson("api/categories/{$category->id}", $newCategory)->assertStatus(200);

  // $this->assertDatabaseHas('categories', array_slice($newCategory, 0, 1));
  $category = Category::factory()->create();

  $newCategory = Category::factory()->raw();

  $this->putJson("api/v1/items/{$category->id}", $newCategory)->assertOk();

  $this->assertDatabaseHas('items', [
      'id' => $category->id,
      'name' => $newCategory['name'],
      'image' => $newCategory['image'],
      'parent_id' => $newCategory['parent_id'],
      'created_at' => $newCategory['created_at'],
  ]);
});

test('delete Category', function () {
  $category = Category::factory()->create();

  deleteJson('api/categories/'.$category->id)->assertStatus(200);

  $this->assertDeleted($category);
});

