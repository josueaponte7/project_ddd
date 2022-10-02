<?php

namespace Videolibrary\Api\Application\Request\Video;

class GetVideoRequest
{
    private string $status;
    
    public function __construct(string $status)
    {
        $this->status = $status;
    }
    
    public function status(): string
    {
        return $this->status;
    }
    
}
