<?php

namespace Devinci\LaravelEssentials\Migrations;

use Devinci\LaravelEssentials\EssentialServiceProvider;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

/**
 * Class CreateUserTable
 * @package Devinci\LaravelEssential\Migrations
 *
 * This migration file is auto-generated by devinci/laravel-essentials
 */
class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('account_status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    /**
     * Publish the migration file to Laravel base path for Migrations.
     *
     * @return void
     */
    public static function publish()
    {
        $sourcePath = __FILE__;
        $destinationPath = base_path('database' . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . date('Y_m_d_His') . '_create_user_table.php');
        $oldNamespace = 'Devinci\LaravelEssentials\Migrations';
        $newNamespace = 'Database\Migrations';

        EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
    }
}
