<?php

namespace Devinci\LoginCore\Requests;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegistrationRequest
 * @package Devinci\LaravelEssential\Requests
 *
 * This file is required and auto-generated for devinci/laravel-essentials
 */
class RegistrationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:8|confirmed'
        ];
    }

}
