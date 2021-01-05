<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

class Money
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): self
    {
        return new self($value);
    }

    public static function empty(): self
    {
        return new self(0);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function percent(int $percent): self
    {
        return new self((int)ceil($this->value * ($percent)/100));
    }

    public function add(Money $amount): self
    {
        return new self($this->value + $amount->value);
    }
}
