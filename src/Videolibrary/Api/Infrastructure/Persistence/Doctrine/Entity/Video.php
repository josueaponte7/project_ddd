<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Videolibrary\Api\Domain\Model\Video\Video as VideoDomain;

class Video
{
    public function __construct(
        private string $id,
        private string $title,
        private int $duration,
        private string $status,
        private ?Collection $subtitles,
        private string $image,
        private DateTimeInterface $createdAt,
        private ?DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromDomain(VideoDomain $video): self
    {
        $videoEntity = new self(
            $video->id()->value(),
            $video->title(),
            $video->duration(),
            $video->status()->value(),
            new ArrayCollection(),
            $video->image(),
            $video->createdAt(),
            null,
        );
        if (!$video->subtitles()->isEmpty()) {
            foreach ($video->subtitles()->getCollection() as $subtitle) {
                $videoEntity->addSubtitle(Subtitle::fromDomain($subtitle));
            }
        }
        return $videoEntity;
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

    public function image(): string
    {
        return $this->image;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function subtitles(): Collection
    {
        return $this->subtitles;
    }

    public function addSubtitle(Subtitle $subtitle): void
    {
        $subtitle->setVideo($this);
        $this->subtitles->add($subtitle);
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}
