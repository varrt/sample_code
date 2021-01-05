<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\ValueObject\AdditionalSalary;
use App\Domain\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class CreateEmployeeCommand
{
    private UuidInterface $id;

    private string $firstName;

    private string $lastName;

    private UuidInterface $departmentId;

    private Money $baseSalary;

    private AdditionalSalary $additionalSalary;

    public function __construct(
        UuidInterface $id,
        string $firstName,
        string $lastName,
        UuidInterface $departmentId,
        Money $baseSalary,
        AdditionalSalary $additionalSalary
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->departmentId = $departmentId;
        $this->baseSalary = $baseSalary;
        $this->additionalSalary = $additionalSalary;
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

    public function getDepartmentId(): UuidInterface
    {
        return $this->departmentId;
    }

    public function getBaseSalary(): Money
    {
        return $this->baseSalary;
    }

    public function getAdditionalSalary(): AdditionalSalary
    {
        return $this->additionalSalary;
    }
}
