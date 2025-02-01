<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Uncategorized',
        ]);
        Category::factory(20)->create();
        Tag::factory(100)->create();
        Blog::factory(30)->create();
        BlogTag::factory(40)->create();
    }
}
