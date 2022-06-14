<?php

namespace App\Factories;

use App\Contracts\Factory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ResponseFactory implements Factory
{
    function create(mixed $payload): Response
    {
        if ($payload instanceof AnonymousResourceCollection) {
            $payload = $payload->response()->getData(true);
        }

        $response = new Response;
        $response->setContent($payload);
        return $response;
    }
}
