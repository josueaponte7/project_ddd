<?php

namespace Videolibrary\Api\Application\Response\Video;

use Videolibrary\Api\Application\Response\Subtitle\SubtitleCollectionResponse;
use Videolibrary\Api\Domain\Model\Video\Video;

class VideoResponse
{
    private string $id;
    private string $title;
    private int $duration;
    private string $status;
    private ?SubtitleCollectionResponse $subtitles;
    private string $image;

    public function __construct(Video $video)
    {
        $this->id = $video->id()->value();
        $this->title = $video->title();
        $this->duration = $video->duration();
        $this->status = $video->status()->value();
        $this->subtitles = $video->subtitles() ? new SubtitleCollectionResponse($video->subtitles()) : null;
        $this->image = $video->image();
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

    final public function subtitles(): ?SubtitleCollectionResponse
    {
        return $this->subtitles;
    }

    public function image(): string
    {
        return $this->image;
    }


    final public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'duration' => $this->duration(),
            'status' => $this->status(),
            'subtitles' => $this->subtitles()?->toArray(),
            'image' => $this->image(),
        ];
    }
}
