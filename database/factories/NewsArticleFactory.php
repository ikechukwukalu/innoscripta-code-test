<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsArticle>
 */
class NewsArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTime,
            'archived_at' => $this->faker->dateTime,
            'news_source_id' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 10),
            'news_source_name' => $this->faker->name,
            'category_name' => $this->faker->name,
            'source_external_id' => $this->faker->uuid,
            'imageUrl' => $this->faker->imageUrl(),
            'active' => $this->faker->boolean,
        ];
    }
}
