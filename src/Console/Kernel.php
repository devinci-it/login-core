<?php

namespace Devinci\LoginCore\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Devinci\LoginCore\Commands\SetupLoginCommand;
use Devinci\LoginCore\Commands\PublishMigrationCommand;
use Devinci\LoginCore\Commands\PublishLoginConfig;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        PublishMigrationCommand::class,
        PublishLoginConfig::class,
        SetupLoginCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Define scheduled tasks here
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
