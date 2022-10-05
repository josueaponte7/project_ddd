<?php

namespace Videolibrary\Api\Application\Command\Video;

use Videolibrary\Api\Application\Request\Video\CreateVideoRequest;
use Videolibrary\Api\Application\Response\Video\VideoResponse;
use Videolibrary\Api\Domain\Model\Subtitle\Subtitle;
use Videolibrary\Api\Domain\Model\Subtitle\SubtitleCollection;
use Videolibrary\Api\Domain\Model\Subtitle\SubtitleId;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
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
        $video = Video::create(
            new VideoId($this->idStringGenerator->generate()),
            $createVideoRequest->title(),
            $createVideoRequest->duration(),
            $createVideoRequest->image(),
            $this->buildSubtitleCollection($createVideoRequest->subtitles()),
        );
        $this->videoRepository->insert($video);

        return new VideoResponse($video);
    }

    private function buildSubtitleCollection(array $subtitles): SubtitleCollection
    {
        $subtitleCollection = SubtitleCollection::init();
        if (!empty($subtitles)) {
            foreach ($subtitles as $subtitle) {
                $subtitleCollection->add(
                    new Subtitle(
                        new SubtitleId($this->idStringGenerator->generate()),
                        $subtitle,
                    ),
                );
            }
        }

        return $subtitleCollection;
    }
}
