<?php

namespace Devinci\LaravelEssentials\Requests;
use Devinci\LaravelEssentials\EssentialServiceProvider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;

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

    /**
     * Publish the request file to Laravel base path for Requests.
     *
     * @return void
     */
public static function publish()
{
    $sourcePath = __FILE__;
    $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Requests' . DIRECTORY_SEPARATOR . 'RegistrationRequest.php');
    $oldNamespace = 'Devinci\LaravelEssentials\Requests';
    $newNamespace = 'App\Requests';

    EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
}
}
