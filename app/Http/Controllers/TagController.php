<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    /**
     * Retrieve all tags.
     *
     * GET /api/v1/tags
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Return the name of all tags
        return $this->successResponse(
            'Tags retrieved successfully.',
            Tag::all(),
        );
    }

    /**
     * Delete a tag.
     *
     * DELETE /api/v1/tags/{id}
     *
     * Returns HTTP 400 if deletion fails due to constraint violations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Tag $tag)
    {
        try {
            $tag->delete();

            return $this->successResponse(
                statusCode: Response::HTTP_NO_CONTENT
            );
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return $this->failureResponse(
                    'Failed to delete the tag because of constraint violation.'
                );
            }
            throw $e; // The global error handlers will catch it.
        }
    }
}
