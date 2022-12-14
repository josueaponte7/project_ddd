<?php

namespace Videolibrary\Api\Application\Response\Video;

use Videolibrary\Api\Domain\Model\Video\Video;

class VideoResponse
{
    private string $id;
    private string $title;
    private int $duration;
    private string $status;

    public function __construct(Video $video)
    {
        $this->id = $video->id()->value();
        $this->title = $video->title();
        $this->duration = $video->duration();
        $this->status = $video->status()->value();
    }

    public function id(): string
    {
        return $this->id;
    }

    final public function title(): string
    {
        return $this->title;
    }

    final public function duration(): int
    {
        return $this->duration;
    }

    final public function status(): string
    {
        return $this->status;
    }

    final public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'duration' => $this->duration(),
            'status' => $this->status(),
        ];
    }
}
