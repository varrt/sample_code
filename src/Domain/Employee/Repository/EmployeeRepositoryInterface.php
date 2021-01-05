<?php
declare(strict_types=1);

namespace App\Domain\Employee\Repository;

use App\Domain\Employee\Employee;

interface EmployeeRepositoryInterface
{
    public function save(Employee $employee): void;
}
