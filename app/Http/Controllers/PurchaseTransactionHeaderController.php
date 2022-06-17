<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Requests\StorePurchaseTransactionHeaderRequest;
use App\Http\Resources\PurchaseTransactionHeaderResource;
use App\UseCases\PurchaseTransaction\CreatePurchaseTransactionUseCase;
use App\UseCases\PurchaseTransaction\DeletePurchaseTransactionUseCase;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionHeadersUseCase;
use App\UseCases\PurchaseTransaction\GetOnePurchaseTransactionHeaderByIdUseCase;
use Illuminate\Http\Response;

class PurchaseTransactionHeaderController extends Controller
{
    public function __construct(
        private GetAllPurchaseTransactionHeadersUseCase    $getAllPurchaseTransactionHeadersUseCase,
        private CreatePurchaseTransactionUseCase           $createPurchaseTransactionUseCase,
        private GetOnePurchaseTransactionHeaderByIdUseCase $getOnePurchaseTransactionHeaderByIdUseCase,
        private DeletePurchaseTransactionUseCase           $deletePurchaseTransactionUseCase,
        private ResponseFactory                            $responseFactory,
    )
    {
        $this->middleware('auth:api');
        $this->middleware('scope:read-purchase-transaction')->only(['index', 'show']);
        $this->middleware('scope:create-purchase-transaction')->only(['store']);
        $this->middleware('scope:delete-purchase-transaction')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = $this->getAllPurchaseTransactionHeadersUseCase->execute();
        $content = PurchaseTransactionHeaderResource::collection($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePurchaseTransactionHeaderRequest $request
     * @return Response
     */
    public function store(StorePurchaseTransactionHeaderRequest $request): Response
    {
        $data = $request->validated();
        $entity = $this->createPurchaseTransactionUseCase->execute($data);
        $content = PurchaseTransactionHeaderResource::make($entity);
        return $this->responseFactory->create($content);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Response
     */
    public function show(string $id): Response
    {
        $data = $this->getOnePurchaseTransactionHeaderByIdUseCase->execute($id);
        $content = PurchaseTransactionHeaderResource::make($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return Response
     */
    public function destroy(string $id): Response
    {
        $data = $this->deletePurchaseTransactionUseCase->execute($id);
        $content = PurchaseTransactionHeaderResource::make($data);
        return $this->responseFactory->create($content);
    }
}
