<?php
    namespace Devinci\LoginCore;

    use Devinci\LoginCore\Commands\PublishLoginConfig;
    use Devinci\LoginCore\Commands\PublishMigrationCommand;
    use Devinci\LoginCore\Commands\SetupLoginCommand;
    use Illuminate\Contracts\Foundation\Application;
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
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupLoginCommand::class,
                PublishMigrationCommand::class,
                PublishLoginConfig::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../stubs/config.stub' => config_path('login.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/'),
        ], 'views');

        $this->publishes([
            __DIR__.'/resources/css' => public_path('css/'),
        ], 'css');


    }


    }
