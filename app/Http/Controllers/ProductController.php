<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\DeleteProductUseCase;
use App\UseCases\Product\GetAllProductsUseCase;
use App\UseCases\Product\GetOneProductByIdUseCase;
use App\UseCases\Product\UpdateProductUseCase;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private  GetAllProductsUseCase    $getAllProductsUseCase,
        private  GetOneProductByIdUseCase $getOneProductByIdUseCase,
        private  CreateProductUseCase     $createProductUseCase,
        private  UpdateProductUseCase     $updateProductUseCase,
        private  DeleteProductUseCase     $deleteProductUseCase,
        private  ResponseFactory          $responseFactory,
    )
    {
        $this->middleware('scope:create-product')->only(['store']);
        $this->middleware('scope:read-product')->only(['index', 'show']);
        $this->middleware('scope:update-product')->only(['update']);
        $this->middleware('scope:delete-product')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $collection = $this->getAllProductsUseCase->execute();
        $content = ProductResource::collection($collection);
        return $this->responseFactory->create($content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return Response
     */
    public function store(StoreProductRequest $request): Response
    {
        $data = $request->validated();
        $entity = $this->createProductUseCase->execute($data);
        $content = ProductResource::make($entity);
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
        $entity = $this->getOneProductByIdUseCase->execute($id);
        $content = ProductResource::make($entity);
        return $this->responseFactory->create($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param string $id
     * @return Response
     */
    public function update(UpdateProductRequest $request, string $id): Response
    {
        $data = $request->validated();
        $entity = $this->updateProductUseCase->execute(compact('id', 'data'));
        $content = ProductResource::make($entity);
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
        $entity = $this->deleteProductUseCase->execute($id);
        $content = ProductResource::make($entity);
        return $this->responseFactory->create($content);
    }
}
