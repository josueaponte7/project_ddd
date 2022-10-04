<?php

namespace Videolibrary\Api\Domain\Model\Video;

use App\Videolibrary\Api\Domain\Model\Status\Status;

interface VideoRepositoryInterface
{
    public function findByStatus(Status $status): VideoCollection;

    public function insert(Video $video): void;
}
