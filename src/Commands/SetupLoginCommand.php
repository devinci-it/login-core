<?php

namespace Devinci\LaravelEssentials\Commands;
use Devinci\LaravelEssentials\LoginCoreServiceProvider;
use Illuminate\Console\Command;

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
        // Get an instance of the LoginCoreServiceProvider
        $essentialServiceProvider = $this->laravel->make('Devinci\LaravelEssentials\LoginCoreServiceProvider');

        // Call the methods
        $essentialServiceProvider->registerPublishing();
        $essentialServiceProvider->loadRoutes();
        $essentialServiceProvider->publishViews();

        return 0;
    }
}
