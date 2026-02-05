<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create_articles');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image_url' => ['nullable', 'url'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
            'status' => ['nullable', 'in:draft,scheduled,published'],
            'published_at' => ['nullable', 'date', 'after:now'],
            'is_featured' => ['nullable', 'boolean'],
            'is_breaking_news' => ['nullable', 'boolean'],

            // SEO fields
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Article title is required',
            'content.required' => 'Article content is required',
            'category_id.required' => 'Please select a category',
            'category_id.exists' => 'Selected category does not exist',
            'published_at.after' => 'Published date must be in the future for scheduled articles',
        ];
    }
}
