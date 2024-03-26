<?php

namespace App\Requests;
use Devinci\LaravelEssentials\EssentialServiceProvider;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;

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

    /**
     * Publish the request file to Laravel base path for Requests.
     *
     * @return void
     */
 public static function publish()
{
    $sourcePath = __FILE__;
    $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Requests' . DIRECTORY_SEPARATOR . 'LoginRequest.php');
    $oldNamespace = 'Devinci\LaravelEssentials\Requests';
    $newNamespace = 'App\Requests';

    EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
}
}
