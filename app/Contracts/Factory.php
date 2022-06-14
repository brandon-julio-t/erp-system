<?php

namespace App\Contracts;

interface Factory
{
    function create(mixed $payload): mixed;
}
