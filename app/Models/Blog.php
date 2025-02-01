<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'content',
    ];

    protected $with = ['category', 'tags'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'blog_tags',
            'blog_id',
            'tag_id'
        );
    }
}
