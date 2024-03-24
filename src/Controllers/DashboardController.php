<?php

namespace Devinci\LaravelEssentials\Controllers;

use Devinci\LaravelEssentials\EssentialServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * Class DashboardController
 * @package Devinci\LaravelEssential\Controllers
 *
 * This file is required and auto-generated for devinci/laravel-essentials
 */
class DashboardController
{
    public function index()
    {
        if (!Auth::check()) {
            // User is not logged in, redirect to the login route
            return redirect()->route('login');
        }

        try {
            $userName = session('username', '');

            if ($userName === '') {
                throw new Exception('Username not found in session');
            }
        } catch (Exception $e) {
            $userName = '';
        }

        return view('home', ['userName' => $userName]);
    }

    /**
     * Publish the controller file to Laravel base path for Controllers.
     *
     * @return void
     */
    public static function publish()
    {
        $sourcePath = __FILE__;
        $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'DashboardController.php');
        $oldNamespace = 'Devinci\LaravelEssentials\Controllers';
        $newNamespace = 'App\Http\Controllers';

        EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
    }

}
