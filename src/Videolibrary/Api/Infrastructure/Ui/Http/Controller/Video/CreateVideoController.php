<?php

namespace Videolibrary\Api\Infrastructure\Ui\Http\Controller\Video;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Videolibrary\Api\Application\Command\Video\CreateVideoHandler;
use Videolibrary\Api\Application\Request\Video\CreateVideoRequest;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;

class CreateVideoController
{
    private CreateVideoHandler $createVideoHandler;

    public function __construct(CreateVideoHandler $createVideoHandler)
    {
        $this->createVideoHandler = $createVideoHandler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $video = ($this->createVideoHandler)(new CreateVideoRequest(
                $request->get('title'),
                $request->get('duration'),
                $request->get('status'),
            ));

            $response = new JsonResponse(
                [
                    'status' => 'ok',
                    'hits' => [
                        $video->toArray(),
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
