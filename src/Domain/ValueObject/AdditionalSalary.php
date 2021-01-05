<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

class AdditionalSalary
{
    private AdditionalSalaryType $type;

    private Money $amountValue;

    private int $percentValue;

    private function __construct(AdditionalSalaryType $type, Money $amountValue, int $percentValue)
    {
        $this->type = $type;
        $this->amountValue = $amountValue;
        $this->percentValue = $percentValue;
    }

    public static function create(AdditionalSalaryType $type, Money $amountValue, int $percentValue): self
    {
        return new self($type, $amountValue, $percentValue);
    }

    public function getType(): AdditionalSalaryType
    {
        return $this->type;
    }

    public function getAmountValue(): Money
    {
        return $this->amountValue;
    }

    public function getPercentValue(): int
    {
        return $this->percentValue;
    }

    public function isPercent(): bool
    {
        return (string)$this->type === AdditionalSalaryType::PERCENT_TYPE;
    }

    public function isConst(): bool
    {
        return (string)$this->type === AdditionalSalaryType::CONST_TYPE;
    }
}
