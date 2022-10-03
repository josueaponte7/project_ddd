<?php

namespace Videolibrary\Api\Application\Response\Subtitle;

use Videolibrary\Api\Domain\Model\Subtitle\SubtitleCollection;

class SubtitleCollectionResponse
{
    private array $subtitles;

    public function __construct(SubtitleCollection $subtitles)
    {
        $this->subtitles = [];
        foreach ($subtitles->getCollection() as $subtitle) {
            $this->subtitles[] = new SubtitleResponse($subtitle);
        }
    }

    public function toArray(): array
    {
        return array_map(function ($subtitle) {
            return $subtitle->toArray();
        }, $this->subtitles());
    }

    public function subtitles(): array
    {
        return $this->subtitles;
    }
}
