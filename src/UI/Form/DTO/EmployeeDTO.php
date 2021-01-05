<?php
declare(strict_types=1);

namespace App\UI\Form\DTO;

class EmployeeDTO
{
    public string $firstName;

    public string $lastName;

    public string $departmentId;

    public int $baseSalary;

    public int $additionPercentValue;

    public int $additionAmountValue;

    public string $additionalType;
}
