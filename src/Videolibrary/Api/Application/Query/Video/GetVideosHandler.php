<?php

namespace Videolibrary\Api\Application\Query\Video;


use Videolibrary\Api\Application\Request\Video\GetVideoRequest;
use Videolibrary\Api\Application\Response\Video\VideoCollectionResponse;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\Status;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface;

class GetVideosHandler
{
    private VideoRepositoryInterface $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * @throws InvalidStatusValueException
     */
    public function __invoke(GetVideoRequest $getVideoRequest): VideoCollectionResponse
    {
        $video = $this->videoRepository->findByStatus(
            new Status($getVideoRequest->status()),
        );

        return new VideoCollectionResponse($video);
    }
}
