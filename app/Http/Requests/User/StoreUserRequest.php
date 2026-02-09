<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create_users');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'exists:roles,name'],
            'status' => ['nullable', 'in:active,suspended,banned'],
        ];
    }
}
