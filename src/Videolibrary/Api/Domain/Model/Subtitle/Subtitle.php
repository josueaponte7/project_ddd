<?php

namespace Videolibrary\Api\Domain\Model\Subtitle;

use Videolibrary\Api\Domain\Model\Video\Video;

class Subtitle
{
    private SubtitleId $id;
    private string $language;
    private string $subtitle;
    private Video $video;
    
    public function __construct(SubtitleId $id, string $language, string $subtitle)
    {
        $this->id = $id;
        $this->language = $language;
        $this->subtitle = $subtitle;
    }
    
    public function id(): SubtitleId
    {
        return $this->id;
    }
    
    public function language(): string
    {
        return $this->language;
    }
    
    public function video(): Video
    {
        return $this->video;
    }
    
    public function subtitle(): string
    {
        return $this->subtitle;
    }
    
}
