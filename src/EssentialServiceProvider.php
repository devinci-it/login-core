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

    }

    /**
     * Display initialization instructions.
     *
     * @return int
     */
    protected function displayInitializationInstructions()
    {
        return 0;

    }

    /**
     * Display support and contribution information.
     *
     * @return int
     * */
    protected function displaySupportAndContributeInfo()
    {
        return 0;
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

        #$this->displayInitializationInstructions();
        #$this->displaySupportAndContributeInfo();
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
    /**
     * Publish and refactor a file.
     *
     * @param  string  $sourcePath
     * @param  string  $destinationPath
     * @param  string  $oldNamespace
     * @param  string  $newNamespace
     * @return void
     */
    public static function publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace)
    {
        try {
            $sourceContent = file_get_contents($sourcePath);
            $updatedContent = str_replace($oldNamespace, $newNamespace, $sourceContent);

            $oldNamespaceDeclaration = 'namespace ' . $oldNamespace . ';';
            $newNamespaceDeclaration = 'namespace ' . $newNamespace . ';';
            $updatedContent = str_replace($oldNamespaceDeclaration, $newNamespaceDeclaration, $updatedContent);

            $oldUseStatement = 'use ' . $oldNamespace;
            $newUseStatement = 'use ' . $newNamespace;
            $updatedContent = str_replace($oldUseStatement, $newUseStatement, $updatedContent);

            $directory = dirname($destinationPath);

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            if (file_exists($destinationPath)) {
                $confirmation = readline("File already exists at the destination path. Do you want to override it? (yes/no): ");

                if (strtolower($confirmation) !== 'yes') {
                    return;
                }
            }

            file_put_contents($destinationPath, $updatedContent);

            echo "File published and refactored successfully.\n";
        } catch (\Exception $e) {
            echo "An error occurred while publishing the file: " . $e->getMessage();
        }
    }
}
