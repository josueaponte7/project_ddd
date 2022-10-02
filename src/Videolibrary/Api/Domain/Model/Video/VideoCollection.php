<?php

namespace Videolibrary\Api\Domain\Model\Video;

use Videolibrary\Api\Domain\Collection\ObjectCollection;

class VideoCollection extends ObjectCollection
{
    
    protected function className(): string
    {
        return Video::class;
    }
}
