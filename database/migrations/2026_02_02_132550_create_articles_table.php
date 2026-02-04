<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image_url')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->enum('status', ['draft', 'scheduled', 'published', 'archived'])
                ->default('draft');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_breaking_news')->default(false);
            $table->timestamp('published_at')->nullable();

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->softDeletes();

            // Indexes for performance
            $table->index('slug');
            $table->index('status');
            $table->index('author_id');
            $table->index('category_id');
            $table->index('published_at');
            $table->index(['status', 'published_at']);
            $table->index(['is_featured', 'published_at']);
            $table->index(['is_breaking_news', 'published_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
