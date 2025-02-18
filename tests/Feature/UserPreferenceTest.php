<?php

namespace Tests\Feature;

use App\Enums\UserPreferenceType;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Category;
use App\Models\NewsApi;
use App\Models\NewsSource;
use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPreferenceTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testErrorValidationForCreateUserPreference()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $postData = [
            'name' => null,
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testCreateUserPreference()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $newsSource = NewsSource::where('model', NewsApi::class)->first();

        $postData = [
            'type' => UserPreferenceType::SOURCE->value,
            'source_type' => UserPreferenceType::NEWS_API->value,
            'preferential_id' => $newsSource->id,
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $author = Author::factory()->create();

        $postData = [
            'type' => UserPreferenceType::AUTHOR->value,
            'preferential_id' => $author->id,
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $category = Category::factory()->create();

        $postData = [
            'type' => UserPreferenceType::CATEGORY->value,
            'preferential_id' => $category->id,
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForDeleteUserPreference()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $postData = [
            'id' => 'abc'
        ];

        $response = $this->deleteJson(route('deleteUserPreference'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testDeleteUserPreference()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $userPreference = UserPreference::factory()->create();

        $postData = [
            'id' => $userPreference->id
        ];

        $response = $this->deleteJson(route('deleteUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadUserPreference(): void
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $userPreference = UserPreference::factory()->create();

        $response = $this->getJson(route('readUserPreference', ['id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readUserPreference', ['id' => $userPreference->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readUserPreference'));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadByUserIdUserPreference(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $userPreference = UserPreference::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson(route('readByUserIdUserPreference', ['user_id' => $user->id, 'id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readByUserIdUserPreference', ['user_id' => $user->id, 'id' => $userPreference->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readByUserIdUserPreference', ['user_id' => $user->id, 'id' => $userPreference->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

}
