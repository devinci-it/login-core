<?php

namespace Devinci\LoginCore\Models;

use Devinci\LoginCore\LoginServiceProvider;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package Devinci\LaravelEssential\Models
 *
 * This file is required and auto-generated for devinci/laravel-essentials
 */
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'account_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->account_status = 'unverified';
        });
    }

    /**
     * Publish the model file to Laravel base path for Models.
     *
     * @return void
     */
public static function publish()
{
    $sourcePath = __FILE__;
    $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'User.php');
    $oldNamespace = 'Devinci\LaravelEssentials\Models';
    $newNamespace = 'App\Models';

    LoginServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
}
}
