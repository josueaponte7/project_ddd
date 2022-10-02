<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Repository;

use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\Status;
use Videolibrary\Api\Domain\Model\Video\Video;
use Videolibrary\Api\Domain\Model\Video\VideoCollection;
use Videolibrary\Api\Domain\Model\Video\VideoId;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface;
use Videolibrary\Api\Infrastructure\Persistence\Doctrine\Entity\Video as VideoEntity;

class DoctrineVideoRepository extends DoctrineRepository implements VideoRepositoryInterface
{

    /**
     * @throws InvalidStatusValueException
     */
    public function findByStatus(Status $status): VideoCollection
    {
        $videos = $this->repository->findBy([
            'status' => $status->value(),
        ]);

        $videoCollection = VideoCollection::init();
        if (!empty($videos)) {
            foreach ($videos as $video) {
                $videoCollection->add($this->toDomain($video));
            }
        }

        return $videoCollection;
    }

    /**
     * @throws InvalidStatusValueException
     */
    private function toDomain(VideoEntity $video): Video
    {
        return new Video(
            new VideoId($video->id()),
            $video->title(),
            $video->duration(),
            new Status($video->status()),
        );
    }

    public function insert(Video $video): void
    {
        $this->entityManager->persist($this->toInfrastructure($video));
        $this->entityManager->flush();
    }

    private function toInfrastructure(Video $video): VideoEntity
    {
        return new VideoEntity(
            $video->id()->value(),
            $video->title(),
            $video->duration(),
            $video->status()->value(),
            $video->createdAt(),
            $video->updatedAt(),
        );
    }

    public function entityClassName(): string
    {
        return VideoEntity::class;
    }
}
