<?php

namespace App\Contracts;

interface
UseCase
{
    function execute(mixed $payload = null): mixed;
}
