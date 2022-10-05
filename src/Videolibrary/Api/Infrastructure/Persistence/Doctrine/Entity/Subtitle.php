<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity;

use Videolibrary\Api\Domain\Model\Subtitle\Subtitle as SubtitleDomain;

class Subtitle
{
    private string $id;
    private string $language;
    private string $subtitle;
    private Video $video;
    
    public function __construct(string $id, string $language, string $subtitle)
    {
        $this->id = $id;
        $this->language = $language;
        $this->subtitle = $subtitle;
    }
    
    public static function fromDomain(SubtitleDomain $subtitle): self
    {
        return new self(
            $subtitle->id()->value(),
            $subtitle->language(),
            $subtitle->subtitle(),
        );
    }
    
    public function id(): string
    {
        return $this->id;
    }
    
    public function language(): string
    {
        return $this->language;
    }
    
    public function subtitle(): string
    {
        return $this->subtitle;
    }
    
    public function video(): Video
    {
        return $this->video;
    }
    
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }
    
}
