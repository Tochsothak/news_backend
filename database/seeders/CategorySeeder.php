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
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
