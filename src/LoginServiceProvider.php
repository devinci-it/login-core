<?php
    namespace Devinci\LoginCore;

    use Devinci\LaravelEssentials\Migrations;
    use Devinci\LoginCore\Commands\SetupLoginCommand;
    use Devinci\LoginCore\Http\Controllers\DashboardController;
    use Devinci\LoginCore\Http\Controllers\UserAccessControl;
    use Devinci\LoginCore\Models\User;
    use Devinci\LoginCore\Repositories\BaseRepository;
    use Devinci\LoginCore\Repositories\UserRepository;
    use Devinci\LoginCore\Requests\LoginRequest;
    use Devinci\LoginCore\Requests\RegistrationRequest;
    use Devinci\LoginCore\Utilities\FileManager;
    use Exception;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\ServiceProvider;

    class LoginServiceProvider extends ServiceProvider
    {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LoginServiceProvider::class, function (Application $app) {
            return new LoginServiceProvider($app);
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
     *
     */
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

        public function publishCSS()
        {
            // Copy CSS files from package to Laravel's public directory
            $sourcePath = __DIR__ . '/resources/css';
            $destinationPath = public_path('css');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            File::copyDirectory($sourcePath, $destinationPath);

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
                $sourceDirectory = base_path('vendor/devinci-it/login-core/src/resources/views/auth');
                $destinationDirectory = resource_path('views');

                // Get all files in the source directory
                $files = glob($sourceDirectory . '/*.{php,blade.php}', GLOB_BRACE);

                // Iterate over each file
                foreach ($files as $file) {
                    // Get the filename without the path
                    $filename = basename($file);

                    // Construct the destination path in the resources/views directory
                    $destinationPath = $destinationDirectory . '/' . $filename;

                    // Copy the file to the destination
                    copy($file, $destinationPath);
                }
            }
    }

        /**
     * Publishes a file from source path to destination path and refactors namespace and use statements.
     *
     * @param string $sourcePath The path to the source file.
     * @param string $destinationPath The path to publish the file.
     * @param string $oldNamespace The old namespace to be replaced.
     * @param string $newNamespace The new namespace to replace the old one.
     * @return void
     */
    public static function publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace)
    {
        try {
            // Instantiate FileManager
            $fileManager = new FileManager();

            // Read the content from source file
            $sourceContent = $fileManager->readFile($sourcePath);

            // Set namespace replacement pairs
            $fileManager->addNamespaceReplacement("Devinci\LaravelEssentials", "App");

            // Add strings to exclude from refactoring
            $fileManager->addRefactorExclusion('use Devinci\LaravelEssentials\EssentialServiceProvider;');

            // Refactor the content
            $updatedContent = $fileManager->refactorContent($sourceContent);

            // Ensure destination directory exists
            $directory = dirname($destinationPath);
            if (!$fileManager->pathExists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Check if file already exists
            if ($fileManager->pathExists($destinationPath)) {
                echo "File already exists at the destination path: $destinationPath\n";
                $confirmation = readline("Do you want to override it? (yes/no)[no]: ");

                if (strtolower($confirmation) !== 'yes') {
                    return;
                }
            }

            $newContent = str_replace('use App\EssentialServiceProvider;', 'use Devinci\LaravelEssentials\EssentialServiceProvider;', $updatedContent);
            $fileManager->writeFile($destinationPath,$newContent);

            echo "$destinationPath: File published and refactored successfully.\n";
        } catch (Exception $e) {
            echo "An error occurred while publishing the file: " . $e->getMessage();
        }
    }

    }
