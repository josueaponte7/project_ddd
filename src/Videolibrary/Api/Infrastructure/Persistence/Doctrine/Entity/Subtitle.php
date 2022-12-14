<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity;

class Subtitle
{
    private string $id;
    private string $language;
    private Video $video;

    public function __construct(string $id, string $language, Video $video)
    {
        $this->id = $id;
        $this->language = $language;
        $this->video = $video;
    }

    public function id(): string
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


}
