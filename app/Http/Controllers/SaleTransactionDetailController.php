<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Resources\SaleTransactionDetailResource;
use App\UseCases\SaleTransaction\GetAllSaleTransactionDetailsUseCase;
use App\UseCases\SaleTransaction\GetOneSaleTransactionDetailByIdUseCase;
use Illuminate\Http\Response;

class SaleTransactionDetailController extends Controller
{
    public function __construct(
        private GetAllSaleTransactionDetailsUseCase    $getAllSaleTransactionDetailsUseCase,
        private GetOneSaleTransactionDetailByIdUseCase $getOneSaleTransactionDetailByIdUseCase,
        private ResponseFactory                        $responseFactory,
    )
    {
        $this->middleware('auth:api');
        $this->middleware('scope:read-sale-transaction')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = $this->getAllSaleTransactionDetailsUseCase->execute();
        $content = SaleTransactionDetailResource::collection($data);
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
        $data = $this->getOneSaleTransactionDetailByIdUseCase->execute($id);
        $content = SaleTransactionDetailResource::make($data);
        return $this->responseFactory->create($content);
    }
}
