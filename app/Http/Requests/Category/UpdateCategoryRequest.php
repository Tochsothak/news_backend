<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('edit_categories');
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($categoryId)
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($categoryId) {
                    if ($value == $categoryId) {
                        $fail('A category cannot be its own parent.');
                    }
                }
            ],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url'],
            'status' => ['nullable', 'in:active,inactive'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
