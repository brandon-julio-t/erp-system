<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            ...parent::toArray($request),
            '_links' => [
                'index' => [
                    'href' => route('products.index'),
                    'ref' => 'index',
                    'type' => ['GET', 'HEAD'],
                ],
                'self' => [
                    'href' => route('products.show', $this),
                    'ref' => 'self',
                    'type' => ['GET', 'HEAD'],
                ],
                'create' => [
                    'href' => route('products.store', $this),
                    'ref' => 'self',
                    'type' => 'POST',
                ],
                'update' => [
                    'href' => route('products.update', $this),
                    'ref' => 'self',
                    'type' => ['PUT', 'PATCH'],
                ],
                'delete' => [
                    'href' => route('products.destroy', $this),
                    'ref' => 'self',
                    'type' => 'DELETE',
                ],
            ],
        ];
    }
}
