<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Requests\IdTodoRequest;

use App\Repositories\ToDo\Todos;
use Illuminate\Support\Facades\DB;

class TodosController extends Controller
{

    protected $repository;

    /**
     * Constructor Method
     */
    public function __construct() {
        $this->repository = new Todos();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {

            $user_id = auth()->user()->id;

            $userTodos = $this->repository->getByUser($user_id);

            return response()->json($userTodos);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTodoRequest $request
     * @return JsonResponse
     */
    public function store(CreateTodoRequest $request): JsonResponse
    {

        try {

            DB::beginTransaction();

            $this->repository->createTodo($request);

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
     * @param  IdTodoRequest $request
     * @return JsonResponse
     */
    public function show(IdTodoRequest $request): JsonResponse
    {
        try {

            $todo = $this->repository->getOne($request->id);

            return response()->json($todo);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTodoRequest $request
     * @return JsonResponse
     */
    public function update(UpdateTodoRequest $request): JsonResponse
    {
        try {

            DB::beginTransaction();

            $this->repository->updateTodo($request);

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
     * @param  IdTodoRequest $request
     * @return JsonResponse
     */
    public function destroy(IdTodoRequest $request): JsonResponse
    {
        try {

            DB::beginTransaction();

            $this->repository->dropTodo($request->id);

            DB::commit();

            return response()->json([]);

        } catch (\Exception $error) {

            DB::rollBack();

            return responseError($error, 'Ops...');

        }
    }
}
