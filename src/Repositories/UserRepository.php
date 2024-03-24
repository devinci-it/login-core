<?php

namespace Devinci\LaravelEssentials\Repositories;

use Devinci\LaravelEssentials\EssentialServiceProvider;
use Devinci\LaravelEssentials\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 *
 * This class represents a dummy API controller.
 * It extends the BaseRepository class and provides basic functionalities for handling dummy data.
 *
 * @package Devinci\LaravelEssentials\Repositories
 */
class UserRepository extends BaseRepository
{
    /**
     * The model instance associated with the repository.
     *
     * @var \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model User
     */
    protected Builder|Model $model;

    /**
     * UserRepository constructor.
     * Initialize the model instance.
     */
    public function __construct()
    {
        $this->model = new User;
    }

    public function testRepo()
    {
        // Create a new User
        $newUser = $this->store(new Request([
            'first_name' => 'value',          // Replace 'value' with the actual value for first_name
            'last_name' => 'value',           // Replace 'value' with the actual value for last_name
            'email' => 'value',               // Replace 'value' with the actual value for email
            'username' => 'value',            // Replace 'value' with the actual value for username
            'password' => 'value',            // Replace 'value' with the actual value for password
            'account_status' => 'unverified', // Replace 'value' with the actual value for account_status
        ]));
        $newUser = json_decode($newUser->getContent(), true);
        $id = $newUser['id'];

        // Read the User
        $User = $this->show($id);

        // Update the User
        $updatedUser = $this->update(new Request([
            'first_name' => 'value',           // Replace 'value' with the actual value for first_name
            'last_name' => 'value',            // Replace 'value' with the actual value for last_name
            'email' => 'value',                // Replace 'value' with the actual value for email
            'username' => 'value',             // Replace 'value' with the actual value for username
            'password' => 'value',             // Replace 'value' with the actual value for password
            'account_status' => 'deactivated', // Replace 'value' with the actual value for account_status
        ]), $id);

        // Delete the User
        $this->destroy($id);

        // Prepare a verbose response
        $response = [
            'message' => 'CRUD operations test completed successfully.',
            'create' => 'Created a new User with ID: ' . $id,
            'read' => 'Read the User with ID: ' . $id,
            'update' => 'Updated the User with ID: ' . $id,
            'delete' => 'Deleted the User with ID: ' . $id,
            'debug' => $newUser
        ];

        return response()->json($response);
    }

    /**
     * Publish the repository file to Laravel base path for Repositories.
     *
     * @return void
     */
    public static function publish()
    {
        $sourcePath = __FILE__;
        $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php');
        $oldNamespace = 'Devinci\LaravelEssentials\Repositories';
        $newNamespace = 'App\Repositories';

        EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
    }
}
