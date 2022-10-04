<?php

namespace Videolibrary\Api\Domain\Model\Video;

use DateTimeImmutable;
use DateTimeInterface;
use Videolibrary\Api\Domain\Model\Subtitle\SubtitleCollection;

class Video
{

    public function __construct(
        private readonly VideoId $id,
        private readonly string $title,
        private readonly int $duration,
        private readonly Status $status,
        private readonly ?SubtitleCollection $subtitles,
        private readonly string $image,
        private readonly DateTimeInterface $createdAt,
        private readonly ?DateTimeInterface $updatedAt,
    ) {
    }

    public function id(): VideoId
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function subtitles(): ?SubtitleCollection
    {
        return $this->subtitles;
    }

    public function image(): string
    {
        return $this->image;
    }

}
