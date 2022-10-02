<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Video
{
    private string $id;
    private string $title;
    private int $duration;
    private string $status;
    private ArrayCollection $subtitles;
    private DateTimeInterface $createdAt;
    private DateTimeInterface $updatedAt;

    public function __construct(
        string $id,
        string $title,
        int $duration,
        string $status,
        ArrayCollection $subtitles,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->duration = $duration;
        $this->status = $status;
        $this->subtitles = $subtitles;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


    public function id(): string
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

    public function status(): string
    {
        return $this->status;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function subtitles(): ArrayCollection
    {
        return $this->subtitles;
    }

}
