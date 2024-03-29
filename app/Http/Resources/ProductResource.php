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
                'update' => [
                    'href' => route('products.update', $this),
                    'ref' => 'self',
                    'type' => ['PUT', 'PATCH'],
                ],
            ],
        ];
    }
}
