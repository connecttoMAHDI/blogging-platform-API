<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogTagFactory extends Factory
{
    protected $model = BlogTag::class;

    public function definition(): array
    {
        return [
            'blog_id' => Blog::all()->random()->id,
            'tag_id' => Tag::all()->random()->id,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (BlogTag $blogTag) {
            // Ensure blog_id and tag_id combination is unique
            while (BlogTag::where('blog_id', $blogTag->blog_id)
                ->where('tag_id', $blogTag->tag_id)
                ->exists()
            ) {
                $blogTag->blog_id = Blog::all()->random()->id;
                $blogTag->tag_id = Tag::all()->random()->id;
                $blogTag->save();
            }
        });
    }
}
