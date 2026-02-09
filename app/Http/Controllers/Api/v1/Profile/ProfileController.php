<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Get authenticated user profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($request->user()->load('roles')),
        ]);
    }

    /**
     * Update authenticated user profile
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => new UserResource($user->fresh()),
        ]);
    }

    /**
     * Upload user avatar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = $request->user();

        // Delete old avatar if exists
        if ($user->avatar_url) {
            $oldPath = str_replace('/storage/', '', parse_url($user->avatar_url, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
        }

        // Store new avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        $url = Storage::url($path);

        $user->update(['avatar_url' => $url]);

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'data' => [
                'avatar_url' => $url,
            ],
        ]);
    }

    /**
     * Delete user avatar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAvatar(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->avatar_url) {
            $path = str_replace('/storage/', '', parse_url($user->avatar_url, PHP_URL_PATH));
            Storage::disk('public')->delete($path);
            $user->update(['avatar_url' => null]);
        }

        return response()->json([
            'message' => 'Avatar deleted successfully',
        ]);
    }

    /**
     * Update password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message' => 'Password updated successfully',
        ]);
    }

    /**
     * Delete account
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete avatar if exists
        if ($user->avatar_url) {
            $path = str_replace('/storage/', '', parse_url($user->avatar_url, PHP_URL_PATH));
            Storage::disk('public')->delete($path);
        }

        // Revoke all tokens
        $user->tokens()->delete();

        // Delete user
        $user->delete();

        return response()->json([
            'message' => 'Account deleted successfully',
        ]);
    }

    /**
     * Get user statistics
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function statistics(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'data' => [
                'articles_count' => $user->articles()->count(),
                'published_articles_count' => $user->articles()->published()->count(),
                'draft_articles_count' => $user->articles()->where('status', 'draft')->count(),
                'comments_count' => $user->comments()->count(),
                'bookmarks_count' => $user->bookmarks()->count(),
            ],
        ]);
    }
}