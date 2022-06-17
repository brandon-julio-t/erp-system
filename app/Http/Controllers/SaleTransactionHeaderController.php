<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Requests\StoreSaleTransactionHeaderRequest;
use App\Http\Resources\SaleTransactionHeaderResource;
use App\UseCases\SaleTransaction\CreateSaleTransactionUseCase;
use App\UseCases\SaleTransaction\DeleteSaleTransactionUseCase;
use App\UseCases\SaleTransaction\GetAllSaleTransactionHeadersUseCase;
use App\UseCases\SaleTransaction\GetOneSaleTransactionHeaderByIdUseCase;
use Illuminate\Http\Response;

class SaleTransactionHeaderController extends Controller
{
    public function __construct(
        private GetAllSaleTransactionHeadersUseCase    $getAllSaleTransactionHeadersUseCase,
        private CreateSaleTransactionUseCase           $createSaleTransactionUseCase,
        private GetOneSaleTransactionHeaderByIdUseCase $getOneSaleTransactionHeaderByIdUseCase,
        private DeleteSaleTransactionUseCase           $deleteSaleTransactionUseCase,
        private ResponseFactory                        $responseFactory,
    )
    {
        $this->middleware('auth:api');
        $this->middleware('scope:read-sale-transaction')->only(['index', 'show']);
        $this->middleware('scope:create-sale-transaction')->only(['store']);
        $this->middleware('scope:delete-sale-transaction')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = $this->getAllSaleTransactionHeadersUseCase->execute();
        $content = SaleTransactionHeaderResource::collection($data);
        return $this->responseFactory->create($content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSaleTransactionHeaderRequest $request
     * @return Response
     */
    public function store(StoreSaleTransactionHeaderRequest $request): Response
    {
        $data = $request->validated();
        $entity = $this->createSaleTransactionUseCase->execute($data);
        $content = SaleTransactionHeaderResource::make($entity);
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
        $data = $this->getOneSaleTransactionHeaderByIdUseCase->execute($id);
        $content = SaleTransactionHeaderResource::make($data);
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
        $data = $this->deleteSaleTransactionUseCase->execute($id);
        $content = SaleTransactionHeaderResource::make($data);
        return $this->responseFactory->create($content);
    }
}
