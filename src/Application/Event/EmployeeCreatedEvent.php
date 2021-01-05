<?php
declare(strict_types=1);

namespace App\Application\Event;

use App\Domain\Employee\Employee;

class EmployeeCreatedEvent
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }
}
