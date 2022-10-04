<?php

namespace Videolibrary\Api\Application\Request\Video;

class CreateVideoRequest
{
    public function __construct(
        private readonly string $title,
        private readonly int $duration,
        private readonly array $subtitles,
        private readonly string $image,
    ) {
    }

    public function title(): string
    {
        return $this->title;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function subtitles(): array
    {
        return $this->subtitles;
    }

    public function image(): string
    {
        return $this->image;
    }


}
