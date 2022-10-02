<?php

namespace Videolibrary\Api\Domain\Model\Video;

interface VideoRepositoryInterface
{
    public function findByStatus(Status $status): VideoCollection;

    public function insert(Video $video): void;
}
