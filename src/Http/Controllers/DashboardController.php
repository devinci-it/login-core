<?php

namespace Devinci\LoginCore\Http\Controllers;
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
    

}
