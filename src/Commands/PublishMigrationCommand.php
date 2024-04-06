<?php

namespace Devinci\LoginCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes the migration file with a timestamp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Constructing the path to the stub file within the library using __DIR__
        $stubPath = __DIR__ . "/../../stubs/modify_user.stub";
        $destinationPath = database_path('migrations/' . date('Y_m_d_His') . '_modify_user_table.php');

        if (!File::exists($destinationPath)) {
            File::copy($stubPath, $destinationPath);
            $this->info("Devinci/LoginCore: $destinationPath.\nMigration File Published.");
            $this->info("To apply the migration, run: php artisan migrate");
        } else {
            $this->error('Migration already exists!');
        }

        return 0;
    }

}