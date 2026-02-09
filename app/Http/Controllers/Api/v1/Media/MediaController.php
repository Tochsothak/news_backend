<?php

namespace App\Http\Controllers\Api\V1\Media;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    /**
     * Upload media file
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'type' => ['required', 'in:image,video,document'],
        ]);

        $file = $request->file('file');
        $type = $request->input('type');

        // Validate file type
        $this->validateFileType($file, $type);

        // Generate unique filename
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store file
        $path = $file->store($type . 's', 'public');
        $url = Storage::url($path);

        // Optimize image if it's an image
        if ($type === 'image') {
            $this->optimizeImage(Storage::path('public/' . $path));
        }

        // Create media record
        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_url' => $url,
            'file_type' => $type,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'uploaded_by' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'data' => new MediaResource($media),
        ], 201);
    }

    /**
     * Get user's media library
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Media::where('uploaded_by', $request->user()->id);

        // Filter by type
        if ($type = $request->input('type')) {
            $query->where('file_type', $type);
        }

        // Search
        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $media = $query->latest()
            ->paginate($request->input('per_page', 20));

        return response()->json([
            'data' => MediaResource::collection($media),
            'meta' => [
                'total' => $media->total(),
                'current_page' => $media->currentPage(),
                'last_page' => $media->lastPage(),
            ],
        ]);
    }

    /**
     * Delete media
     *
     * @param Media $media
     * @return JsonResponse
     */
    public function destroy(Media $media): JsonResponse
    {
        // Check ownership or admin permission
        if ($media->uploaded_by !== auth()->id() && !auth()->user()->can('delete_media')) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        // Delete file from storage
        Storage::disk('public')->delete($media->file_path);

        // Delete record
        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully',
        ]);
    }

    /**
     * Validate file type
     */
    private function validateFileType($file, $type): void
    {
        $allowedMimes = [
            'image' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            'video' => ['video/mp4', 'video/quicktime', 'video/x-msvideo'],
            'document' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        ];

        if (!in_array($file->getMimeType(), $allowedMimes[$type])) {
            abort(422, 'Invalid file type for ' . $type);
        }
    }

    /**
     * Optimize image (requires intervention/image package)
     */
    private function optimizeImage(string $path): void
    {
        // Uncomment if using intervention/image
        // Image::make($path)
        //     ->resize(1920, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     })
        //     ->save($path, 85);
    }
}