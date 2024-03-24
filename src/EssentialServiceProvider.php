<?php

namespace Devinci\LaravelEssentials;

use Devinci\LaravelEssentials\Commands\SetupLoginCommand;
use Devinci\LaravelEssentials\Controllers\DashboardController;
use Devinci\LaravelEssentials\Controllers\UserAccessControl;
use Devinci\LaravelEssentials\Migrations\CreateUserTable;
use Devinci\LaravelEssentials\Models\User;
use Devinci\LaravelEssentials\Repositories\BaseRepository;
use Devinci\LaravelEssentials\Repositories\UserRepository;
use Devinci\LaravelEssentials\Requests\LoginRequest;
use Devinci\LaravelEssentials\Requests\RegistrationRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class EssentialServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EssentialServiceProvider::class, function (Application $app) {
            return new EssentialServiceProvider($app);
        });

//        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-essentials');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupLoginCommand::class,
            ]);
        }
	//Publish Essential Files
        $this->registerPublishing();
	// Load routes
        $this->loadRoutes();
        // Publish Blade views
        $this->publishViews();
}

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    public function registerPublishing()
    {
        if ($this->app->runningInConsole()) {

            // Publish Migrations
            CreateUserTable::publish();
            User::publish();
            // Publish Repositories
            BaseRepository::publish();
            UserRepository::publish();

            // Publish Controllers
            UserAccessControl::publish();
            DashboardController::publish();

            // Publish Requests
            RegistrationRequest::publish();
            LoginRequest::publish();
        }
    }
 /**
 * Load package routes.
 *
 * @return void
 */
public function loadRoutes()
{
    $sourcePath = __DIR__.'/routes/web.php';
    $destinationPath = base_path('routes' . DIRECTORY_SEPARATOR . 'web.php');
    $oldNamespace = 'Devinci\LaravelEssentials';
    $newNamespace = 'App';

    self::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
}

/**
 * Publish Blade views.
 *
 * @return void
 */
public function publishViews()
{
    if ($this->app->runningInConsole()) {
        $sourceDirectory = __DIR__.'/resources/views';
        $destinationDirectory = resource_path('views/vendor/laravel-essentials');
        $oldNamespace = 'Devinci\LaravelEssentials';
        $newNamespace = '';

        // Get all files in the source directory
        $files = glob($sourceDirectory . '/*');

        // Iterate over each file
        foreach ($files as $file) {
            // Check if the path is a file
            if (is_file($file)) {
                // Construct the destination path
                $destinationPath = $destinationDirectory . '/' . basename($file);

                // Call the publishAndRefactor method for each file
                self::publishAndRefactor($file, $destinationPath, $oldNamespace, $newNamespace);
            }
        }
    }
}
    public static function publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace)
    {
        $sourceContent = file_get_contents($sourcePath);
        $updatedContent = str_replace($oldNamespace, $newNamespace, $sourceContent);

        // Replace old namespace declaration with new one
        $oldNamespaceDeclaration = 'namespace ' . $oldNamespace.';';
        $newNamespaceDeclaration = 'namespace ' . $newNamespace.';';
        $updatedContent = str_replace($oldNamespaceDeclaration, $newNamespaceDeclaration, $updatedContent);

        // Replace old use statements with new ones
        $oldUseStatement = 'use ' . $oldNamespace;
        $newUseStatement = 'use ' . $newNamespace;
        $updatedContent = str_replace($oldUseStatement, $newUseStatement, $updatedContent);

        // Get the directory name from the destination path
        $directory = dirname($destinationPath);

        // Check if the directory exists, if not create it
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($destinationPath, $updatedContent);
    }

}
