<?php

namespace Videolibrary\Api\Infrastructure\Service;

use Ramsey\Uuid\Uuid;
use Videolibrary\Api\Domain\Service\IdStringGeneratorInterface;

class UuidIdStringGenerator implements IdStringGeneratorInterface
{
    public function generate(): string
    {
        return Uuid::uuid4();
    }

}
