<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Retrieve all blogs with their category and tags.
     *
     * GET /api/v1/blogs
     *
     * Optionally, filter blogs using a search 'term'.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get the search 'term' from query
        $term = request()->query('term', null);

        // Get an instance of query
        $query = Blog::query();

        // If search 'term' was provided, search for blogs
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('title', 'LIKE', "%{$term}%")
                    ->orWhere('content', 'LIKE', "%{$term}%")
                    ->orWhereHas('category', function ($q) use ($term) {
                        $q->where('name', 'LIKE', "%{$term}%");
                    });
            });
        }

        // Fetch the blogs
        $blogs = $query->get();

        return $this->successResponse(
            'Blogs retrieved successfully.',
            BlogResource::collection($blogs)
        );
    }

    /**
     * Create a new blog post.
     *
     * POST /api/v1/blogs
     *
     * Request body:
     * - title (string, required)
     * - content (string, required)
     * - category_id (integer, required)
     * - tags (array, optional)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBlogRequest $request)
    {
        // Get the validated payload
        $payload = $request->validated();

        // Ensure 'tags' key exists in payload
        $tags = $payload['tags'] ?? [];

        // Find or create tags and retrieve their IDs
        $tagIds = [];
        foreach ($tags as $t) {
            $tag = Tag::firstOrCreate(['name' => $t]);
            $tagIds[] = $tag->id;
        }

        // Create the blog post
        $blog = Blog::create($payload);

        // Attach tags to the blog (many-to-many relationship)
        $blog->tags()->sync($tagIds);

        // Refresh the blog instance to load relations
        $blog->refresh();

        return $this->successResponse(
            'Blog created successfully.',
            new BlogResource($blog),
            Response::HTTP_CREATED
        );
    }

    /**
     * Retrieve a single blog post along with its category and tags.
     *
     * GET /api/v1/blogs/{id}
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Blog $blog)
    {
        return $this->successResponse(
            'Blog retrieved successfully.',
            new BlogResource($blog),
        );
    }

    /**
     * Update an existing blog post.
     *
     * PUT /api/v1/blogs/{id}
     *
     * Request body:
     * - title (string, optional)
     * - content (string, optional)
     * - category_id (integer, optional)
     * - tags (array, optional)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // Get the validated payload
        $payload = $request->validated();

        // Ensure 'tags' key exists in payload
        $tags = $payload['tags'] ?? [];

        // Find or create tags and retrieve their IDs
        $tagIds = [];
        foreach ($tags as $t) {
            $tag = Tag::firstOrCreate(['name' => $t]);
            $tagIds[] = $tag->id;
        }

        // Update the blog post
        $blog->update($payload);

        // Only sync tags if they are provided and have changed
        if (! empty($tags)) {
            $blog->tags()->sync($tagIds);
        }

        // Refresh the blog instance to load relations
        $blog->refresh();

        return $this->successResponse(
            'Blog updated successfully.',
            new BlogResource($blog),
            Response::HTTP_OK
        );
    }

    /**
     * Delete a blog post.
     *
     * DELETE /api/v1/blogs/{id}
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Blog $blog)
    {
        // Detach tags associated with the blog
        $blog->tags()->detach();

        // Delete the blog
        $blog->delete();

        return $this->successResponse(
            statusCode: Response::HTTP_NO_CONTENT
        );
    }
}
