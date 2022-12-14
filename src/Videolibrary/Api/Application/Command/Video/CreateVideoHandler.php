<?php

namespace Videolibrary\Api\Application\Command\Video;

use Videolibrary\Api\Application\Request\Video\CreateVideoRequest;
use Videolibrary\Api\Application\Response\Video\VideoResponse;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\Status;
use Videolibrary\Api\Domain\Model\Video\Video;
use Videolibrary\Api\Domain\Model\Video\VideoId;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface as VideoRepository;
use Videolibrary\Api\Domain\Service\IdStringGeneratorInterface as idStringGenerator;

class CreateVideoHandler
{
    private VideoRepository $videoRepository;
    private IdStringGenerator $idStringGenerator;

    public function __construct(VideoRepository $videoRepository, IdStringGenerator $idStringGenerator)
    {
        $this->videoRepository = $videoRepository;
        $this->idStringGenerator = $idStringGenerator;
    }

    /**
     * @throws InvalidStatusValueException
     */
    public function __invoke(CreateVideoRequest $createVideoRequest): VideoResponse
    {
        $video = new Video(
            new VideoId($this->idStringGenerator->generate()),
            $createVideoRequest->title(),
            $createVideoRequest->duration(),
            new Status($createVideoRequest->status()),

        );
        $this->videoRepository->insert($video);

        return new VideoResponse($video);
    }
}
