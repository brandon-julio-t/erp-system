<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
                    'href' => route('users.index'),
                    'ref' => 'index',
                    'type' => ['GET', 'HEAD'],
                ],
                'self' => [
                    'href' => route('users.show', $this),
                    'ref' => 'self',
                    'type' => ['GET', 'HEAD'],
                ],
                'create-user' => [
                    'href' => route('users.store', $this),
                    'ref' => 'self',
                    'type' => 'POST',
                ],
                'update-user' => [
                    'href' => route('users.update', $this),
                    'ref' => 'self',
                    'type' => ['PUT', 'PATCH'],
                ],
                'delete-user' => [
                    'href' => route('users.destroy', $this),
                    'ref' => 'self',
                    'type' => 'DELETE',
                ],
            ],
        ];
    }
}
