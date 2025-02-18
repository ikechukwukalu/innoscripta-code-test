<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\NewsArticle;
use App\Models\NewsSource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsArticleTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testErrorValidationForUpdateNewsArticle()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc',
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('updateNewsArticle'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testUpdateNewsArticle()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $category = Category::factory()->create();
        $newsSource = NewsSource::factory()->create();
        $newsArticle = NewsArticle::factory()->create([
                'category_id' => $category->id,
                'news_source_id' => $newsSource->id,
                'active' => '1',
        ]);

        $postData = [
            'id' => $newsArticle->id,
            'active' => '0',
        ];

        $response = $this->putJson(route('updateNewsArticle'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testErrorValidationForDeleteNewsArticle()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $postData = [
            'id' => 'abc'
        ];

        $response = $this->deleteJson(route('deleteNewsArticle'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);
    }

    public function testDeleteNewsArticle()
    {
        $user = User::factory()->create(['model' => Admin::class]);

        $this->actingAs($user);

        $category = Category::factory()->create();
        $newsSource = NewsSource::factory()->create();
        $newsArticle = NewsArticle::factory()->create([
                'category_id' => $category->id,
                'news_source_id' => $newsSource->id,
                'active' => '1',
        ]);

        $postData = [
            'id' => $newsArticle->id
        ];

        $response = $this->deleteJson(route('deleteNewsArticle'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

    public function testReadNewsArticle(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::factory()->create();
        $newsSource = NewsSource::factory()->create();
        $newsArticle = NewsArticle::factory()->create([
                'category_id' => $category->id,
                'news_source_id' => $newsSource->id,
                'active' => '1',
        ]);

        $response = $this->getJson(route('readNewsArticle', ['id' => 'all']));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readNewsArticle', ['id' => $newsArticle->id]));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);

        $response = $this->getJson(route('readNewsArticle'));
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }

}
