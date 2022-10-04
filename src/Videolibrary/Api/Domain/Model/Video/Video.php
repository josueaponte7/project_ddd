<?php

namespace Videolibrary\Api\Domain\Model\Video;

use App\Videolibrary\Api\Domain\Model\Status\Status;
use DateTimeImmutable;
use DateTimeInterface;
use Videolibrary\Api\Domain\Model\Subtitle\SubtitleCollection;

class Video
{
    private VideoId $id;
    private string $title;
    private int $duration;
    private Status $status;
    private ?SubtitleCollection $subtitles;
    private string $image;
    private DateTimeInterface $createdAt;
    private ?DateTimeInterface $updatedAt;
    private bool $flat;
    
    private function __construct()
    {
    }
    
    public static function create(
        VideoId $id,
        string $title,
        int $duration,
        string $image,
        SubtitleCollection $subtitles,
    ): self {
        $video = new self();
        $video->id = $id;
        $video->title = $title;
        $video->duration = $duration;
        $video->status = Status::makePublished();
        $video->image = $image;
        $video->subtitles = $subtitles;
        $video->createdAt = new DateTimeImmutable();
        $video->updatedAt = null;
        
        return $video;
    }
    
    /**
     * @throws InvalidStatusValueException
     */
    public static function fromPrimitive(
        string $id,
        string $title,
        int $duration,
        string $status,
        string $image,
        DateTimeInterface $createdAt,
        ?DateTimeInterface $updatedAt,
    ): self {
        $video = new self();
        $video->id = new VideoId($id);
        $video->title = $title;
        $video->duration = $duration;
        $video->status = new Status($status);
        $video->subtitles = null;
        $video->image = $image;
        $video->createdAt = $createdAt;
        $video->updatedAt = $updatedAt;
        
        return $video;
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
