<?php
declare(strict_types=1);

namespace App\Application\Projection\SalaryReport;

use Ramsey\Uuid\UuidInterface;

class SalaryReport
{
    private UuidInterface $id;

    private string $firstName;

    private string $lastName;

    private string $department;

    private int $baseSalary;

    private string $additionType;

    private int $additionalAmount;

    private int $totalSalary;

    public function __construct(
        UuidInterface $id,
        string $firstName,
        string $lastName,
        string $department,
        int $baseSalary,
        string $additionType,
        int $additionalAmount,
        int $totalSalary
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->department = $department;
        $this->baseSalary = $baseSalary;
        $this->additionType = $additionType;
        $this->additionalAmount = $additionalAmount;
        $this->totalSalary = $totalSalary;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getBaseSalary(): int
    {
        return $this->baseSalary;
    }

    public function getAdditionType(): string
    {
        return $this->additionType;
    }

    public function getAdditionalAmount(): int
    {
        return $this->additionalAmount;
    }

    public function getTotalSalary(): int
    {
        return $this->totalSalary;
    }
}
