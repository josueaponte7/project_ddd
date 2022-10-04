<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
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
        $subtitles = new ArrayCollection();
        if (!$video->subtitles()->isEmpty()) {
            foreach ($video->subtitles()->getCollection() as $subtitle) {
                $subtitles->add(Subtitle::fromDomain($subtitle));
            }
        }

        return new self(
            $video->id()->value(),
            $video->title(),
            $video->duration(),
            $video->status()->value(),
            $subtitles,
            $video->image(),
            $video->createdAt(),
            $video->updatedAt(),
        );
    }

    public function subtitles(): ?Collection
    {
        return $this->subtitles;
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

    public function updatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function addSubtitle(Subtitle $subtitle): void
    {
        $subtitle->setVideo($this);
        $this->subtitles->add($subtitle);
    }


    /**
     * @throws InvalidStatusValueException
     */
    public function toDomain(): VideoDomain
    {
        return VideoDomain::fromPrimitive(
            $this->id(),
            $this->title(),
            $this->duration(),
            $this->status(),
            $this->image(),
            $this->createdAt(),
            $this->updatedAt(),
        );
    }

}
