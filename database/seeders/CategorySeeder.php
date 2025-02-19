<?php

namespace Database\Seeders;

use App\Facades\Category as CategoryFacade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Business',
            'Entertainment',
            'General',
            'Health',
            'Science',
            'Sports',
            'Technology',
            'Home',
            'World',
            'Arts',
            'Politics',
            'Books',
            'Fashion'
        ];

        foreach ($categories as $category) {
            CategoryFacade::firstOrCreate([
                'name' => $category
            ], [
                'name' => $category,
                'active' => '1',
            ]);
        }
    }
}
