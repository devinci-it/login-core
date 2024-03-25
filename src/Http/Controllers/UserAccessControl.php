<?php

namespace Devinci\LaravelEssentials\Http\Controllers;



use Devinci\LaravelEssentials\Requests\RegistrationRequest;
use Devinci\LaravelEssentials\Requests\LoginRequest;
use Devinci\LaravelEssentials\Models\User;
use Devinci\LaravelEssentials\Repositories\UserRepository;

use Devinci\LaravelEssentials\EssentialServiceProvider;



use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Devinci\LaravelEssentials\Http\Controllers\Controller;

/**
 * Class UserAccessControl
 * @package Devinci\LaravelEssential\Controllers
 *
 * This file is required and auto-generated for devinci/laravel-essentials
 *
 * Views required:
 * - login.blade.php
 * - register.blade.php
 * - dashboard.blade.php
 */
class UserAccessControl extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userLogin(LoginRequest $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            // Retrieve the user by the username
            $user = User::where('username', $credentials['username'])->first();

            // Check if the user exists and the password is correct
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                throw new Exception('Invalid login credentials');
            }

            // Attempt to log in the user
            Auth::login($user);
            Session::put('username', $user->username);

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Handle user registration.
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function userRegistration(RegistrationRequest $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validated();
            $validatedData['account_status'] = 'unverified';
            $validatedData['password'] = bcrypt($validatedData['password']);

            $newUserResponse = $this->userRepository->store(new Request($validatedData));
            $responseData = json_decode($newUserResponse->getContent(), true);

            // Check if user registration was successful
            if ($responseData['status'] === 'success') {
                // Extract user data from the response
                $userData = $responseData['data'];

                // Log in the user automatically
                Auth::loginUsingId($userData['id']);

                // Redirect to the home page after successful registration and login
                return redirect()->route('home')->with('success', 'Registration successful');
            } else {
                // Registration failed, redirect back with error message
                return redirect()->back()->with('error', $responseData['message']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function renderLoginForm()
    {
        return view('login');
    }

    public function renderRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('register');
    }


    public function debugUsers()
    {
        $userRepo = new UserRepository();
        return $userRepo->testRepo();
    }

    /**
     * Publish the controller file to Laravel base path for Controllers.
     *
     * @return void
     */
public static function publish()
{
    $sourcePath = __FILE__;
    $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'UserAccessControl.php');
    $oldNamespace = 'Devinci\\LaravelEssentials\\Controllers';
    $newNamespace = 'App\\Http\\Controllers';

    EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
}
}
