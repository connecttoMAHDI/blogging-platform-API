<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Get the search 'term' from query

        // Get an instance of query

        // If search 'term' was provided, search for blogs with
        // Matched title.
        // Matched content.
        // Or matched category.

        // Response template:
        /*
            [
                {
                    "id": 1,
                    "title": "My First Blog Post",
                    "content": "This is the content of my first blog post.",
                    "category": "Technology",
                    "tags": ["Tech", "Programming"],
                    "createdAt": "2021-09-01T12:00:00Z",
                    "updatedAt": "2021-09-01T12:00:00Z"
                },
                {
                    "id": 2,
                    "title": "My Second Blog Post",
                    "content": "This is the content of my second blog post.",
                    "category": "Technology",
                    "tags": ["Tech", "Programming"],
                    "createdAt": "2021-09-01T12:30:00Z",
                    "updatedAt": "2021-09-01T12:30:00Z"
                }
            ]
        */
    }

    public function store(Request $request)
    {
        // Get 'title', 'content', ('category' as category_id), and a list of 'tags'
        // Everything except the tags are required.

        // Tag can only be letter, numbers and hyphen

        // Use findOrCreate for tags to create the tags that doesn't exist

        // Response template:
        /*
            {
                "id": 1,
                "title": "My First Blog Post",
                "content": "This is the content of my first blog post.",
                "category": "Technology",
                "tags": ["Tech", "Programming"],
                "createdAt": "2021-09-01T12:00:00Z",
                "updatedAt": "2021-09-01T12:00:00Z"
            }
        */
    }

    public function show(Blog $blog)
    {
        // Just show the blog with the following format
        /*
            {
                "id": 1,
                "title": "My First Blog Post",
                "content": "This is the content of my first blog post.",
                "category": "Technology",
                "tags": ["Tech", "Programming"],
                "createdAt": "2021-09-01T12:00:00Z",
                "updatedAt": "2021-09-01T12:00:00Z"
            }
        */
    }

    public function update(Request $request, Blog $blog)
    {
        // Get 'title', 'content', ('category' as category_id), and a list of 'tags'
        // All fields are nullable, if it is null then it will stay unaffected

        // Update the blog

        // Response template
        /*
            {
                "id": 1,
                "title": "My Updated Blog Post",
                "content": "This is the updated content of my first blog post.",
                "category": "Technology",
                "tags": ["Tech", "Programming"],
                "createdAt": "2021-09-01T12:00:00Z",
                "updatedAt": "2021-09-01T12:30:00Z"
            }
        */
    }

    public function destroy(Blog $blog)
    {
        // Delete the blog and return 204
    }
}
