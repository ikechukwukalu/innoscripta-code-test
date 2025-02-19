<?php

namespace Tests\Feature;

use App\Enums\UserPreferenceType;
use App\Models\Admin;
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

        $postData = [
            'type' => UserPreferenceType::SOURCE->value,
            'tag' => 'News API'
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $postData = [
            'type' => UserPreferenceType::CATEGORY->value,
            'tag' => 'Business'
        ];

        $response = $this->postJson(route('createUserPreference'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $postData = [
            'type' => UserPreferenceType::AUTHOR->value,
            'tag' => 'Kalu Ikechukwu'
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
