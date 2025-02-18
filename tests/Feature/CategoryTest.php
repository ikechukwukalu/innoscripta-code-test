<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testErrorValidationForCreateCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'name' => null,
        ];

        $response = $this->postJson(route('createCategory'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testCreateCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'name' => $this->faker->name(),
        ];

        $response = $this->postJson(route('createCategory'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForUpdateCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc',
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateCategory'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testUpdateCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $category = Category::factory()->create();

        $postData = [
            'id' => $category->id,
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateCategory'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForDeleteCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc'
        ];

        $response = $this->deleteJson(route('deleteCategory'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testDeleteCategory()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $category = Category::factory()->create();

        $postData = [
            'id' => $category->id
        ];

        $response = $this->deleteJson(route('deleteCategory'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadCategory(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::factory()->create();

        $response = $this->getJson(route('readCategory', ['id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readCategory', ['id' => $category->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readCategory'));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

}
