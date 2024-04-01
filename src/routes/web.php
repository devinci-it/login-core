<?php

use Devinci\LaravelEssentials\Http\Controllers\UserAccessControl;
use Devinci\LaravelEssentials\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your package. These
| routes will be loaded by the consuming application. Make something great!
|
*/

// Routes accessible to all users
Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [DashboardController::class, 'index'])->name('home');

/*__________________________________________________*/
/*                 AUTHENTICATION ROUTES             */
/*__________________________________________________*/

// Routes accessible to non-authenticated users
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserAccessControl::class, 'renderRegistrationForm'])->name('register');
    Route::get('/login', [UserAccessControl::class, 'renderLoginForm'])->name('login');

    // Route for submitting login and registration
    Route::post('/login', [UserAccessControl::class, 'userLogin']);
    Route::post('/register', [UserAccessControl::class, 'userRegistration']);
});

// Routes accessible to authenticated users
Route::middleware('auth')->group(function () {
    // Route for logging out
    Route::get('/logout', [UserAccessControl::class, 'userLogout']);
    Route::post('/logout', [UserAccessControl::class, 'userLogout'])->name('logout');

    // Route for debugging users
    Route::get('/debug_user', [UserAccessControl::class, 'debugUsers'])->name('debug');
});

// Fallback route
Route::fallback(function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        return redirect('home'); // Redirect authenticated users to the home page
    } else {
        return redirect('login');
    }
});
