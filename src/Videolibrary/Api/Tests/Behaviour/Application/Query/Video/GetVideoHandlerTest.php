<?php

namespace Videolibrary\Api\Tests\Behaviour\Application\Query\Video;

use PHPUnit\Framework\TestCase;
use Videolibrary\Api\Application\Query\Video\GetVideosHandler;
use Videolibrary\Api\Application\Request\Video\GetVideoRequest;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;
use Videolibrary\Api\Domain\Model\Video\VideoCollection;
use Videolibrary\Api\Domain\Model\Video\VideoNotFoundException;
use Videolibrary\Api\Domain\Model\Video\VideoRepositoryInterface;

class GetVideoHandlerTest extends TestCase
{
    private VideoRepositoryInterface $videoRepository;
    
    /**
     * @throws InvalidStatusValueException
     */
    public function testInvokeMustThrowExceptionWithEmptyVideoCollection(): void
    {
        $this->expectException(VideoNotFoundException::class);
        $this->videoRepository->method('findByStatus')->willReturn(VideoCollection::init());
        (new GetVideosHandler($this->videoRepository))(new GetVideoRequest('published'));
        
    }
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->videoRepository = $this->createMock(VideoRepositoryInterface::class);
    }
}
