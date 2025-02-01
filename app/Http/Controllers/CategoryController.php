<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Retrieve all categories.
     *
     * GET /api/v1/categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Return the name of all tags
        return $this->successResponse(
            'Categories retrieved successfully.',
            Category::all(),
        );
    }

    /**
     * Create a new category.
     *
     * POST /api/v1/categories
     *
     * Request body:
     * - name (string, required, max: 64)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate(['name' => 'required|string|max:64']);

        // Create the tag
        $category = Category::create(['name' => $request->name]);

        return $this->successResponse(
            'Category created successfully.',
            $category,
            Response::HTTP_CREATED
        );
    }

    /**
     * Delete a category.
     *
     * DELETE /api/v1/categories/{id}
     *
     * Returns HTTP 400 if deletion fails due to constraint violations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Category $category)
    {
        try {
            $category->delete();

            return $this->successResponse(
                statusCode: Response::HTTP_NO_CONTENT
            );
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return $this->failureResponse(
                    'Failed to delete the category because of constraint violation.'
                );
            }
            throw $e; // The global error handlers will catch it.
        }
    }
}
