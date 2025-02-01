<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function blogs()
    {
        return $this->belongsToMany(
            Blog::class,
            'blog_tags',
            'tag_id',     // Foreign key of the current model (Tag) in the pivot table
            'blog_id'     // Foreign key of the related model (Blog) in the pivot table
        );
    }
}
