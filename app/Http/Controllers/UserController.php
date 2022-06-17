<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\CreateUserUseCase;
use App\UseCases\User\DeleteUserUseCase;
use App\UseCases\User\GetAllUsersUseCase;
use App\UseCases\User\GetCurrentUserUseCase;
use App\UseCases\User\GetOneUserByIdUseCase;
use App\UseCases\User\UpdateUserUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private  GetCurrentUserUseCase $getCurrentUserUseCase,
        private  GetAllUsersUseCase    $getAllUsersUseCase,
        private  GetOneUserByIdUseCase $getOneUserByIdUseCase,
        private  CreateUserUseCase     $createUserUseCase,
        private  UpdateUserUseCase     $updateUserUseCase,
        private  DeleteUserUseCase     $deleteUserUseCase,
        private  ResponseFactory       $responseFactory,
    )
    {
        $this->middleware('scope:create-user')->only(['store']);
        $this->middleware('scope:read-user')->only(['me', 'index', 'show']);
        $this->middleware('scope:update-user')->only(['update']);
        $this->middleware('scope:delete-user')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function me(Request $request): Response
    {
        $data = $this->getCurrentUserUseCase->execute($request);
        $content = UserResource::make($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = $this->getAllUsersUseCase->execute();
        $content = UserResource::collection($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request): Response
    {
        $data = $request->validated();
        $entity = $this->createUserUseCase->execute($data);
        $content = UserResource::make($entity);
        return $this->responseFactory->create($content);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $data = $this->getOneUserByIdUseCase->execute(compact('id'));
        $content = UserResource::make($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id): Response
    {
        $data = $request->validated();
        $entity = $this->updateUserUseCase->execute(compact('id', 'data'));
        $content = UserResource::make($entity);
        return $this->responseFactory->create($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $entity = $this->deleteUserUseCase->execute(compact('id'));
        $content = UserResource::make($entity);
        return $this->responseFactory->create($content);
    }
}
