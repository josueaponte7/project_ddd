<?php

namespace App\Videolibrary\Api\Domain\Model\Status;

use Videolibrary\Api\Domain\Model\Video\InvalidStatusValueException;

class Status
{
    public const PUBLISHED = 'published';
    public const PENDING = 'pending';
    public const REMOVED = 'removed';
    public const ALLOWED_VALUES = [
        self::PUBLISHED,
        self::PENDING,
        self::REMOVED,
    ];
    
    /**
     * @throws InvalidStatusValueException
     */
    public function __construct(private readonly string $value)
    {
        if (!in_array($value, self::ALLOWED_VALUES)) {
            throw new InvalidStatusValueException();
        }
    }
    
    public static function makePublished(): self
    {
        return new self(self::PUBLISHED);
    }
    
    public static function makePending(): self
    {
        return new self(self::PENDING);
    }
    
    public static function makeRemoved(): self
    {
        return new self(self::REMOVED);
    }
    
    public function equals(Status $status): bool
    {
        return $this->value() === $status->value();
    }
    
    public function value(): string
    {
        return $this->value;
    }
    
    public function isPublished(): bool
    {
        return $this->value() === self::PUBLISHED;
    }
    
    
}
