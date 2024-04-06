<?php

namespace Devinci\LoginCore\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Devinci\LoginCore\Commands\PublishMigrationCommand;
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
        $this->line('Devinci LoginCore config published successfully!');

        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginCoreServiceProvider',
            '--tag' => 'views',
        ]);

        $this->line('Devinci LoginCore views published successfully!');
        $this->line('If resources were not properly published , execute `php artisan vendor:publish --tag=views`');

        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginCoreServiceProvider',
            '--tag' => 'resources',
        ]);

        $publishMigrationCommand = new PublishMigrationCommand();
        $publishMigrationCommand->handle();

        // Call the handle method of PublishLoginConfig
        $publishLoginConfig = new PublishLoginConfig();
        $publishLoginConfig->handle();




        return 0;
    }
}
