<?php

namespace Devinci\LoginCore\Routes;

use Devinci\LoginCore\Http\Controllers\DashboardController;
use Devinci\LoginCore\Http\Controllers\UserAccessControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class RouteRegistrar
{
    public static function registerRoutes()
    {
        $authenticatedRoutes = config('devinci-login.authenticated_routes');
        $guestRoutes = config('devinci-login.guest_routes');

        // Routes accessible to all users
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        // Authentication routes
        Route::middleware('guest')->group(function () use ($guestRoutes) {
            foreach ($guestRoutes as $route) {
                Route::get("/$route", [UserAccessControl::class, "render{$route}Form"])->name($route);
            }
            Route::post('/login', [UserAccessControl::class, 'userLogin']);
            Route::post('/register', [UserAccessControl::class, 'userRegistration']);
        });

        // Routes accessible to authenticated users
        Route::middleware('auth')->group(function () use ($authenticatedRoutes) {
            foreach ($authenticatedRoutes as $route) {
                Route::get("/$route", [DashboardController::class, 'render{$route}'])->name($route);
            }
            Route::get('/logout', [UserAccessControl::class, 'userLogout']);
            Route::post('/logout', [UserAccessControl::class, 'userLogout'])->name('logout');
        });

        // Fallback route
        Route::fallback(function () {
            if (Auth::check()) {
                return redirect('home');
            } else {
                return redirect('login');
            }
        });
    }
}
