<?php

namespace Videolibrary\Api\Application\Query\Video;


use App\Videolibrary\Api\Domain\Model\Status\Status;
use Videolibrary\Api\Application\Request\Video\GetVideoRequest;
use Videolibrary\Api\Application\Response\Video\VideoCollectionResponse;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\VideoCollection;
use Videolibrary\Api\Domain\Model\Video\VideoNotFoundException;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface;

class GetVideosHandler
{
    private VideoRepositoryInterface $videoRepository;
    
    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    
    /**
     * @throws VideoNotFoundException
     * @throws InvalidStatusValueException
     */
    public function __invoke(GetVideoRequest $getVideoRequest): VideoCollectionResponse
    {
        return new VideoCollectionResponse(
            $this->getVideos(new Status($getVideoRequest->status()))
        );
    }
    
    /**
     * @throws VideoNotFoundException
     */
    private function getVideos(Status $status): VideoCollection
    {
        $video = $this->videoRepository->findByStatus($status,);
        if ($video->isEmpty()) {
            throw new VideoNotFoundException();
        }
    }
}
