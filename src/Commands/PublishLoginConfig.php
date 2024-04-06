<?php

namespace Devinci\LoginCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PublishLoginConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the login configuration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if output interface is set, otherwise use default output
//        $output = $this->getOutput() ?: $this->output;

        // Your command logic here
//        $output->info('Publishing login configuration...');

        // Example: Call the vendor:publish command
        Artisan::call('vendor:publish', [
            '--provider' => 'Devinci\LoginCore\LoginCoreServiceProvider',
            '--tag' => ['config']
        ]);

//        $output->line('Login configuration published successfully.');
    }
}
