<?php

namespace Videolibrary\Api\Infrastructure\Persistence\InMemory\Repository;

use App\Videolibrary\Api\Domain\Model\Status\Status;
use Videolibrary\Api\Domain\Model\Video\Video;
use Videolibrary\Api\Domain\Model\Video\VideoCollection;
use Videolibrary\Api\Domain\Model\Video\VideoId;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface;

class InMemoryVideoRepository implements VideoRepositoryInterface
{
    private array $videos = [];

    public function __construct()
    {
        $this->videos[] = new Video(
            new VideoId('1'),
            'video published 1',
            120,
            new Status('published'),
        );

        $this->videos[] = new Video(
            new VideoId('2'),
            'video published 2',
            120,
            new Status('published'),
        );

        $this->videos[] = new Video(
            new VideoId('3'),
            'video pending 1',
            120,
            new Status('pending'),
        );

        $this->videos[] = new Video(
            new VideoId('4'),
            'video pending 2',
            120,
            new Status('pending'),
        );

        $this->videos[] = new Video(
            new VideoId('5'),
            'video removed 1',
            120,
            new Status('removed'),
        );
    }

    public function findByStatus(Status $status): VideoCollection
    {
        $videoCollection = new VideoCollection();

        array_map(
            function ($video) use (
                $videoCollection,
                $status,
            ) {
                if ($video->status()->equals($status)) {
                    $videoCollection->add($video);
                }
            },
            $this->videos);

        return $videoCollection;
    }

    public function insert(Video $video): void
    {
        // TODO: Implement insert() method.
    }
}
