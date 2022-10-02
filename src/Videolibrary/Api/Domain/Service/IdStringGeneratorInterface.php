<?php

namespace Videolibrary\Api\Domain\Service;

interface IdStringGeneratorInterface
{
    public function generate(): string;
}
