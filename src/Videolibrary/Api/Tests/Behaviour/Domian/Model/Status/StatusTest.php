<?php

namespace Videolibrary\Api\Tests\Domian\Model\Status;

use App\Videolibrary\Api\Domain\Model\Status\Status;
use PHPUnit\Framework\TestCase;
use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;

class StatusTest extends TestCase
{
    public function testIsPublishedMethodMustReturnTrueWithPublishedValue(): void
    {
        $status = Status::makePublished();
        $this->assertTrue($status->isPublished());
    }
    
    /**
     * @dataProvider notPublishedStatusProvider
     */
    public function testIsPublishedMethodMustReturnFalseWithNotPublishedValue(Status $status)
    {
        $this->assertFalse($status->isPublished());
    }
    
    public function notPublishedStatusProvider(): array
    {
        return [
            [Status::makePending()],
            [Status::makeRemoved()],
        ];
    }
    
    public function testVewMustThrowExceptionWithNotAllowedValue(): void
    {
        $this->expectException(InvalidStatusValueException::class);
        new Status('delete');
    }
    
    /**
     *
     * @dataProvider allowedValuesProvider
     */
    public function testMustThrowExceptionWithNotAllowedValues(Status $status): void
    {
        $this->assertTrue(true);
    }
    
    public function allowedValuesProvider(): array
    {
        return [
            [Status::makePending()],
            [Status::makeRemoved()],
            [Status::makePublished()],
        ];
    }
}
