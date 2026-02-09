<?php

namespace App\Http\Controllers\Api\V1\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Get all active categories
     */
    public function index(): JsonResponse
    {
        $categories = Category::with('children')
            ->active()
            ->root()
            ->orderBy('order')
            ->get();

        return response()->json([
            'data' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Get single category
     */
    public function show(string $slug): JsonResponse
    {
        $category = Category::with(['children', 'parent'])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Create category
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category),
        ], 201);
    }

    /**
     * Update category
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $category->update($request->validated());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Delete category
     */
    public function destroy(Category $category): JsonResponse
    {
        // Check if category has articles
        if ($category->articles()->count() > 0) {
            return response()->json([
                'message' => 'Cannot delete category with articles',
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }
}
