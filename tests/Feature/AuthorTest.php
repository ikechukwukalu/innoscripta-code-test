<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testErrorValidationForCreateAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'name' => null,
        ];

        $response = $this->postJson(route('createAuthor'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testCreateAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'name' => $this->faker->name(),
            'twitter' => $this->faker->userName(),
            'website' => $this->faker->url(),
            'imageUrl' => $this->faker->imageUrl(),
            'active' => 1
        ];

        $response = $this->postJson(route('createAuthor'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForUpdateAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc',
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateAuthor'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testUpdateAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $authors = Author::factory()->create();

        $postData = [
            'id' => $authors->id,
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateAuthor'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForDeleteAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc'
        ];

        $response = $this->deleteJson(route('deleteAuthor'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testDeleteAuthor()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $authors = Author::factory()->create();

        $postData = [
            'id' => $authors->id
        ];

        $response = $this->deleteJson(route('deleteAuthor'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadAuthor(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $authors = Author::factory()->create();

        $response = $this->getJson(route('readAuthor', ['id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readAuthor', ['id' => $authors->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readAuthor'));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

}
