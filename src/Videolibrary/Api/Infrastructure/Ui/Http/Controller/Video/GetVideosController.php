<?php

namespace Videolibrary\Api\Infrastructure\Ui\Http\Controller\Video;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Videolibrary\Api\Application\Query\Video\GetVideosHandler;
use Videolibrary\Api\Application\Request\Video\GetVideoRequest;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;

class GetVideosController
{
    private GetVideosHandler $getVideosHandler;

    /**
     * @param GetVideosHandler $getVideosHandler
     */
    public function __construct(GetVideosHandler $getVideosHandler)
    {
        $this->getVideosHandler = $getVideosHandler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $videos = ($this->getVideosHandler)(
                new GetVideoRequest($request->get('status', 'published')),
            );
            $response = new JsonResponse(
                [
                    'status' => 'ok',
                    'hits' => [
                        $videos->toArray(),
                    ],
                ],
                200);
        } catch (InvalidStatusValueException $e) {
            $response = new JsonResponse(
                [
                    'status' => 'error',
                    'errorMessage' => 'Invalid status value',
                ],
                500);
        }

        return $response;
    }
}
