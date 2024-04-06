<?php

namespace Devinci\LoginCore\Commands;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Devinci\LoginCore\Commands\PublishLoginConfig;

class SetupLoginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the login system by publishing necessary files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'config',
        ]);

        // Get an instance of the LoginServiceProvider
        $loginServiceProvider = $this->laravel->make('Devinci\LoginCore\LoginServiceProvider');
        // Call the methods
        $loginServiceProvider->registerPublishing();
        $loginServiceProvider->loadRoutes();
        $loginServiceProvider->publishViews();
        $loginServiceProvider->publishCSS();

        return 0;
    }
}
