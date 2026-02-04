<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Articles
            'view_articles',
            'create_articles',
            'edit_own_articles',
            'edit_all_articles',
            'delete_own_articles',
            'delete_all_articles',
            'publish_articles',
            'schedule_articles',
            'feature_articles',
            'mark_breaking_news',

            // Categories
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',

            // Tags
            'view_tags',
            'create_tags',
            'edit_tags',
            'delete_tags',

            // Users
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'assign_roles',

            // Comments
            'view_comments',
            'moderate_comments',
            'delete_comments',

            // Media
            'upload_media',
            'delete_media',
            'view_media_library',

            // Analytics
            'view_analytics',
            'export_analytics',

            // Settings
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Super Admin - has all permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view_articles',
            'create_articles',
            'edit_all_articles',
            'delete_all_articles',
            'publish_articles',
            'schedule_articles',
            'feature_articles',
            'mark_breaking_news',
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',
            'view_tags',
            'create_tags',
            'edit_tags',
            'delete_tags',
            'view_users',
            'create_users',
            'edit_users',
            'view_comments',
            'moderate_comments',
            'delete_comments',
            'upload_media',
            'delete_media',
            'view_media_library',
            'view_analytics',
            'export_analytics',
        ]);

        // Editor
        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'view_articles',
            'create_articles',
            'edit_all_articles',
            'publish_articles',
            'schedule_articles',
            'feature_articles',
            'view_categories',
            'create_categories',
            'edit_categories',
            'view_tags',
            'create_tags',
            'edit_tags',
            'view_comments',
            'moderate_comments',
            'upload_media',
            'view_media_library',
            'view_analytics',
        ]);

        // Author
        $author = Role::create(['name' => 'author']);
        $author->givePermissionTo([
            'view_articles',
            'create_articles',
            'edit_own_articles',
            'delete_own_articles',
            'view_categories',
            'view_tags',
            'upload_media',
            'view_media_library',
        ]);

        // Subscriber
        $subscriber = Role::create(['name' => 'subscriber']);
        $subscriber->givePermissionTo([
            'view_articles',
        ]);
    }
}
