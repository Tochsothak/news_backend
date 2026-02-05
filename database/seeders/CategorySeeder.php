<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Politics', 'description' => 'Political news and updates', 'order' => 1],
            ['name' => 'Business', 'description' => 'Business and economy news', 'order' => 2],
            ['name' => 'Technology', 'description' => 'Tech news and innovations', 'order' => 3],
            ['name' => 'Sports', 'description' => 'Sports news and scores', 'order' => 4],
            ['name' => 'Entertainment', 'description' => 'Entertainment and celebrity news', 'order' => 5],
            ['name' => 'Health', 'description' => 'Health and wellness news', 'order' => 6],
            ['name' => 'Science', 'description' => 'Science and research news', 'order' => 7],
            ['name' => 'World', 'description' => 'International news', 'order' => 8],
            ['name' => 'Lifestyle', 'description' => 'Lifestyle and culture', 'order' => 9],
            ['name' => 'Opinion', 'description' => 'Opinion pieces and editorials', 'order' => 10],

            // Additional useful categories
            ['name' => 'Travel', 'description' => 'Travel news, guides, and tips', 'order' => 11],
            ['name' => 'Education', 'description' => 'News about schools, universities, and learning', 'order' => 12],
            ['name' => 'Environment', 'description' => 'Environmental news and climate change', 'order' => 13],
            ['name' => 'Culture', 'description' => 'Arts, literature, and cultural events', 'order' => 14],
            ['name' => 'Food', 'description' => 'Food, recipes, and culinary news', 'order' => 15],
            ['name' => 'Fashion', 'description' => 'Fashion trends and style updates', 'order' => 16],
            ['name' => 'Automobile', 'description' => 'Automobile news, reviews, and trends', 'order' => 17],
            ['name' => 'Real Estate', 'description' => 'Housing, property, and real estate news', 'order' => 18],
            ['name' => 'Gaming', 'description' => 'Video games and esports news', 'order' => 19],
            ['name' => 'Technology Startups', 'description' => 'Startups, entrepreneurship, and innovation', 'order' => 20],
        ];


        foreach ($categories as $category) {
            Category::updateOrCreate(
                ["name" => $category["name"],],
                $category
            );
        }
    }
}
