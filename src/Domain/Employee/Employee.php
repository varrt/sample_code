<?php
declare(strict_types=1);

namespace App\Domain\Employee;

use App\Domain\Department\Department;
use App\Domain\ValueObject\AdditionalSalary;
use App\Domain\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class Employee
{
    private UuidInterface $id;

    private string $firstName;

    private string $lastName;

    private Department $department;

    private Money $baseSalary;

    private AdditionalSalary $additionalSalary;

    public function __construct(
        UuidInterface $id,
        string $firstName,
        string $lastName,
        Department $department,
        Money $baseSalary,
        AdditionalSalary $additionalSalary
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->department = $department;
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

    public function getDepartment(): Department
    {
        return $this->department;
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
