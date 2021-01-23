<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Repositories\Auth\UserRepository;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{

    protected $repository;

    /**
     * Constructor Method
     */
    public function __construct() {
        $this->repository = new UserRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {

            $users = $this->repository->getAll();

            if($users->count() <= 0)
                abort(404, 'Nenhum usuário foi encontrado');

            return response()->json($users);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        try {

            DB::beginTransaction();

            $this->repository->create($request);

            DB::commit();

            return response()->json([]);

        } catch (\Exception $error) {

            DB::rollBack();

            return responseError($error, 'Ops...');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {

            $user = $this->repository->getOne($id);

            return response()->json($user);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {

            DB::beginTransaction();

            $this->repository->updateUser($request);

            DB::commit();

            return response()->json([]);

        } catch (\Exception $error) {

            DB::rollBack();

            return responseError($error, 'Ops...');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {

            DB::beginTransaction();

            $this->repository->dropUser($id);

            DB::commit();

            return response()->json([]);

        } catch (\Exception $error) {

            DB::rollBack();

            return responseError($error, 'Ops...');

        }
    }
}
