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
        $this->info('[SUCCESS] Publishing Devinci LoginCore config...');
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'config',
        ]);
        $this->info('[SUCCESS] Devinci LoginCore config published successfully!');

        $this->info('[SUCCESS] Publishing Devinci LoginCore views...');
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'views',
        ]);
        $this->info('[SUCCESS] Devinci LoginCore views published successfully!');
        $this->info('[SUCCESS] If resources were not properly published , execute `php artisan vendor:publish --tag=views`');

        $this->info('Publishing Devinci LoginCore resources...');
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'resources',
        ]);

        $this->info('Publishing Devinci LoginCore CSS...');
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'css',
        ]);

        $this->info('[SUCCESS] Running PublishMigrationCommand...');
        $publishMigrationCommand = new PublishMigrationCommand();
        $publishMigrationCommand->handle();

        $this->info('[SUCCESS] Running PublishLoginConfig');
        $publishLoginConfig = new PublishLoginConfig();
        $publishLoginConfig->handle();

        $this->info('[SUCCESS] SetupLoginCommand completed successfully.');

        return 0;
    }
}
