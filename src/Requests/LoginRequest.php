<?php

namespace Devinci\LoginCore\Requests;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package Devinci\LaravelEssential\Requests
 *
 * This file is required and auto-generated for devinci/laravel-essentials
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|max:255',
            'password' => 'required|min:8',
        ];
    }

}
