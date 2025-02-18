<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\NewsSource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsSourceTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testErrorValidationForUpdateNewsSource()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc',
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateNewsSource'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testUpdateNewsSource()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $newsSource = NewsSource::factory()->create();

        $postData = [
            'id' => $newsSource->id,
            'name' => $this->faker->name(),
            'url' => $this->faker->url(),
            'active' => '1',
        ];

        $response = $this->putJson(route('updateNewsSource'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForDeleteNewsSource()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc'
        ];

        $response = $this->deleteJson(route('deleteNewsSource'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testDeleteNewsSource()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $newsSource = NewsSource::factory()->create();

        $postData = [
            'id' => $newsSource->id
        ];

        $response = $this->deleteJson(route('deleteNewsSource'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadNewsSource(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $newsSource = NewsSource::factory()->create();

        $response = $this->getJson(route('readNewsSource', ['id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readNewsSource', ['id' => $newsSource->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readNewsSource'));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

}
