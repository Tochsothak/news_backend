<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get all users (with pagination, filters, search)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::with('roles');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by role
        if ($role = $request->input('role')) {
            $query->role($role);
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sort
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->paginate($request->input('per_page', 20));

        return response()->json([
            'data' => UserResource::collection($users),
            'meta' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
            ],
            'links' => [
                'first' => $users->url(1),
                'last' => $users->url($users->lastPage()),
                'prev' => $users->previousPageUrl(),
                'next' => $users->nextPageUrl(),
            ],
        ]);
    }

    /**
     * Get single user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => new UserResource($user->load('roles')),
        ]);
    }

    /**
     * Create new user
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => $request->status ?? 'active',
        ]);

        // Assign role if provided
        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user->load('roles')),
        ], 201);
    }

    /**
     * Update user
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Update role if provided
        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        }

        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user->fresh()->load('roles')),
        ]);
    }

    /**
     * Delete user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot delete your own account',
            ], 422);
        }

        // Prevent deleting super admin
        if ($user->hasRole('super_admin')) {
            return response()->json([
                'message' => 'Cannot delete super admin',
            ], 422);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }

    /**
     * Assign role to user
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function assignRole(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'role' => ['required', 'exists:roles,name'],
        ]);

        // Prevent changing super admin role
        if ($user->hasRole('super_admin') && auth()->user()->id !== $user->id) {
            return response()->json([
                'message' => 'Cannot change super admin role',
            ], 422);
        }

        $user->syncRoles([$request->role]);

        return response()->json([
            'message' => 'Role assigned successfully',
            'data' => new UserResource($user->fresh()->load('roles')),
        ]);
    }

    /**
     * Suspend user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function suspend(User $user): JsonResponse
    {
        // Prevent suspending yourself
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot suspend your own account',
            ], 422);
        }

        // Prevent suspending super admin
        if ($user->hasRole('super_admin')) {
            return response()->json([
                'message' => 'Cannot suspend super admin',
            ], 422);
        }

        $user->update(['status' => 'suspended']);

        // Revoke all tokens
        $user->tokens()->delete();

        return response()->json([
            'message' => 'User suspended successfully',
            'data' => new UserResource($user),
        ]);
    }

    /**
     * Activate user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function activate(User $user): JsonResponse
    {
        $user->update(['status' => 'active']);

        return response()->json([
            'message' => 'User activated successfully',
            'data' => new UserResource($user),
        ]);
    }

    /**
     * Ban user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function ban(User $user): JsonResponse
    {
        // Prevent banning yourself
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot ban your own account',
            ], 422);
        }

        // Prevent banning super admin
        if ($user->hasRole('super_admin')) {
            return response()->json([
                'message' => 'Cannot ban super admin',
            ], 422);
        }

        $user->update(['status' => 'banned']);

        // Revoke all tokens
        $user->tokens()->delete();

        return response()->json([
            'message' => 'User banned successfully',
            'data' => new UserResource($user),
        ]);
    }
}
