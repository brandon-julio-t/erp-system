<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SaleTransactionHeaderResource extends JsonResource
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
                    'href' => route('purchase-transactions.index'),
                    'ref' => 'index',
                    'type' => ['GET', 'HEAD'],
                ],
                'self' => [
                    'href' => route('purchase-transactions.show', $this),
                    'ref' => 'self',
                    'type' => ['GET', 'HEAD'],
                ],
                'create' => [
                    'href' => route('purchase-transactions.store', $this),
                    'ref' => 'self',
                    'type' => 'POST',
                ],
                'delete' => [
                    'href' => route('purchase-transactions.destroy', $this),
                    'ref' => 'self',
                    'type' => 'DELETE',
                ],
            ]
        ];
    }
}
