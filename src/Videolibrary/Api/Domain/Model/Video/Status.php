<?php

namespace Videolibrary\Api\Domain\Model\Video;

class Status
{
    const ALLOWED_VALUES = [
        'pending',
        'published',
        'removed',
    ];
    private string $value;
    
    /**
     * @throws InvalidStatusValueException
     */
    public function __construct(string $value)
    {
        
        if (
            !in_array($value,
                self::ALLOWED_VALUES)
        ) {
            throw new InvalidStatusValueException();
        }
        $this->value = $value;
    }
    
    public function equals(Status $status): bool
    {
        return $this->value() === $status->value();
    }
    
    public function value(): string
    {
        return $this->value;
    }
}
