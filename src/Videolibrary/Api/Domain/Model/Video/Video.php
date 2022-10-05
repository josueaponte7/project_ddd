<?php

namespace Videolibrary\Api\Domain\Model\Video;

use DateTimeImmutable;
use DateTimeInterface;
use Videolibrary\Api\Domain\Model\Subtitle\SubtitleCollection;

class Video
{
    private DateTimeInterface $createdAt;
    private DateTimeInterface $updatedAt;

    public function __construct(
        private VideoId $id,
        private string $title,
        private int $duration,
        private Status $status,
        private ?SubtitleCollection $subtitles,
        private string $image,
    ) {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
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

    public function createdAt(): DateTimeInterface
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
