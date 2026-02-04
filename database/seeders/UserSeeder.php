<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Testing\Fakes\Fake;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'superadmin@news.com',
            'password' => Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin
        $admin = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Editor
        $editor = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Editor User',
            'email' => 'editor@news.com',
            'password' => Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $editor->assignRole('editor');

        // Author
        $author = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Author User',
            'email' => 'author@news.com',
            'password' => Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $author->assignRole('author');

        // Subscriber
        $subscriber = User::create([
            'uuid' => Str::uuid(),
            'name' => 'Subscriber User',
            'email' => 'subscriber@news.com',
            'password' => Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $subscriber->assignRole('subscriber');
    }
}
