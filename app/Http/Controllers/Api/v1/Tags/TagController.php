<?php

namespace App\Http\Controllers\Api\V1\Tags;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Get all tags
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Tag::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Sort by popular (most articles)
        if ($request->input('popular')) {
            $query->withCount('articles')
                ->orderBy('articles_count', 'desc');
        } else {
            $query->orderBy('name');
        }

        $tags = $query->get();

        return response()->json([
            'data' => TagResource::collection($tags),
        ]);
    }

    /**
     * Create tag
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        $tag = Tag::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Tag created successfully',
            'data' => new TagResource($tag),
        ], 201);
    }

    /**
     * Update tag
     *
     * @param Request $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function update(Request $request, Tag $tag): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name,' . $tag->id],
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Tag updated successfully',
            'data' => new TagResource($tag),
        ]);
    }

    /**
     * Delete tag
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();

        return response()->json([
            'message' => 'Tag deleted successfully',
        ]);
    }
}
