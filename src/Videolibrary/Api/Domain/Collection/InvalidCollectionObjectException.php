<?php

namespace Videolibrary\Api\Domain\Collection;

use Exception;

class InvalidCollectionObjectException extends Exception
{
    public function __construct($current, string $expected)
    {
        parent::__construct(
            sprintf('"%s" is not a valid object for collection. Expected "%s"', get_class($current), $expected),
        );
    }
}
