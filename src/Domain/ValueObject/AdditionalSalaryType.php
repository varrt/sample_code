<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class AdditionalSalaryType
{
    const PERCENT_TYPE = "percent";
    const CONST_TYPE = "const";

    private string $type;

    private function __construct(string $type)
    {
        if (!in_array($type, self::toArray())) {
            throw new InvalidArgumentException("Invalid additional salary type.");
        }

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function __toString(): string
    {
        return $this->type;
    }

    public static function percentType(): self
    {
        return new self(self::PERCENT_TYPE);
    }

    public static function constType(): self
    {
        return new self(self::CONST_TYPE);
    }

    public static function fromString(string $type)
    {
        return new self($type);
    }

    public static function toArray(): array
    {
        return [
            self::PERCENT_TYPE,
            self::CONST_TYPE
        ];
    }
}
