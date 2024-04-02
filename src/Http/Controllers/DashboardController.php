<?php

namespace Devinci\LoginCore\Http\Controllers;
use Devinci\LoginCore\LoginServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;


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

        return view('home')->with('username', $userName);
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

        LoginServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
    }

}
