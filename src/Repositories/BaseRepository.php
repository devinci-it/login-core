<?php

/**
 * BaseRepository Class
 *
 * This class serves as a base repository for handling basic CRUD operations.
 * To use this repository, extend it and set the $model property to the corresponding Eloquent model.
 *
 * @category Repository
 * @package  Devinci\LaravelEssentials\Repositories
 */

namespace App\Repositories;

use App\Http\Controllers\Controller;
use Devinci\LaravelEssentials\EssentialServiceProvider;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseRepository extends Controller
{
    /**
     * The model associated with the repository.
     *
     * @var Builder|Model
     */

    protected Builder|Model $model;

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $createdModel = $this->model->create($request->all());
            return response()->json([
                'status' => 'success',
                'id' => $createdModel->id,
                'data' => $createdModel
            ], 201);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $item = $this->model->findOrFail($id);
        $item->update($request->all());
        return response()->json($item, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->model::destroy($id);
        return response()->json(['message' => 'Resource successfully deleted'], 200);
    }

    /**
     * Publish the repository file to Laravel base path for Repositories.
     *
     * @return void
     */
    public static function publish()
    {
        $sourcePath = __FILE__;
        $destinationPath = base_path('app' . DIRECTORY_SEPARATOR . 'Repositories' . DIRECTORY_SEPARATOR . 'BaseRepository.php');
        $oldNamespace = 'Devinci\LaravelEssentials\Repositories';
        $newNamespace = 'App\Repositories';

        EssentialServiceProvider::publishAndRefactor($sourcePath, $destinationPath, $oldNamespace, $newNamespace);
    }
}
