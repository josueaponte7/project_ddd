<?php

namespace Videolibrary\Api\Infrastructure\Persistence\Doctrine\Repository;


use App\Videolibrary\Api\Domain\Model\Status\Status;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\Video;
use Videolibrary\Api\Domain\Model\Video\VideoCollection;
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
                $videoCollection->add($video->toDomain());
            }
        }

        return $videoCollection;
    }

    public function insert(Video $video): void
    {
        $this->entityManager->persist(VideoEntity::fromDomain($video));
        $this->entityManager->flush();
    }

    public function entityClassName(): string
    {
        return VideoEntity::class;
    }

}
