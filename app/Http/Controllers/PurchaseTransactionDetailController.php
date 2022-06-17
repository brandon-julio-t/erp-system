<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Resources\PurchaseTransactionDetailResource;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionDetailsUseCase;
use App\UseCases\PurchaseTransaction\GetOnePurchaseTransactionDetailByIdUseCase;
use Illuminate\Http\Response;

class PurchaseTransactionDetailController extends Controller
{
    public function __construct(
        private GetAllPurchaseTransactionDetailsUseCase    $getAllPurchaseTransactionDetailsUseCase,
        private GetOnePurchaseTransactionDetailByIdUseCase $getOnePurchaseTransactionDetailByIdUseCase,
        private ResponseFactory                            $responseFactory,
    )
    {
        $this->middleware('auth:api');
        $this->middleware('scope:read-purchase-transaction')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = $this->getAllPurchaseTransactionDetailsUseCase->execute();
        $content = PurchaseTransactionDetailResource::collection($data);
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
        $data = $this->getOnePurchaseTransactionDetailByIdUseCase->execute($id);
        $content = PurchaseTransactionDetailResource::make($data);
        return $this->responseFactory->create($content);
    }
}
