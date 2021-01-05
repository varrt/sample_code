<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Event\EmployeeCreatedEvent;
use App\Domain\Department\Repository\DepartmentRepositoryInterface;
use App\Domain\Employee\Employee;
use App\Domain\Employee\Repository\EmployeeRepositoryInterface;
use App\Domain\Exception\DepartmentNotFoundException;
use Psr\EventDispatcher\EventDispatcherInterface;

class CreateEmployeeHandler
{
    private EmployeeRepositoryInterface $employeeRepository;

    private DepartmentRepositoryInterface $departmentRepository;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateEmployeeCommand $command): void
    {
        $department = $this->departmentRepository->findById($command->getDepartmentId());

        if (!$department) {
            throw new DepartmentNotFoundException($command->getDepartmentId()->toString());
        }

        $employee = new Employee(
            $command->getId(),
            $command->getFirstName(),
            $command->getLastName(),
            $department,
            $command->getBaseSalary(),
            $command->getAdditionalSalary()
        );

        $this->employeeRepository->save($employee);

        $this->eventDispatcher->dispatch(new EmployeeCreatedEvent($employee));
    }
}
