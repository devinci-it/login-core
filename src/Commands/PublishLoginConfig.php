<?php
namespace Devinci\LoginCore\Commands;

use Illuminate\Console\Command;

class PublishLoginConfig extends Command
{
    protected $signature = 'login:publish-config';

    protected $description = 'Publish the configuration file for Devinci LoginCore package';

    public function handle()
    {
        // Publish the configuration file
        $this->call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginServiceProvider',
            '--tag' => 'config',
        ]);

        $this->info('Devinci LoginCore configuration file published successfully!');
    }
}
