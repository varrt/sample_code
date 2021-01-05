<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\CreateDepartmentCommand;
use App\Application\Command\CreateDepartmentHandler;
use App\Application\Command\CreateEmployeeCommand;
use App\Application\Command\CreateEmployeeHandler;
use App\Domain\Department\Department;
use App\Domain\Department\Repository\DepartmentRepositoryInterface;
use App\Domain\Employee\Repository\EmployeeRepositoryInterface;
use App\Domain\Exception\DepartmentNotFoundException;
use App\Domain\ValueObject\AdditionalSalary;
use App\Domain\ValueObject\AdditionalSalaryType;
use App\Domain\ValueObject\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateEmployeeHandlerTest extends TestCase
{
    private DepartmentRepositoryInterface $departmentRepository;

    private EmployeeRepositoryInterface $employeeRepository;

    private CreateEmployeeHandler $handler;

    public function setUp(): void
    {
        $this->departmentRepository = $this->createMock(DepartmentRepositoryInterface::class);
        $this->employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $this->handler = new CreateEmployeeHandler($this->employeeRepository, $this->departmentRepository);
    }

    public function testCreateEmployee(): void
    {
        $departmentId = Uuid::uuid4();

        $command = new CreateEmployeeCommand(
            Uuid::uuid4(),
            "Paweł",
            "Maj",
            $departmentId,
            Money::create(10),
            AdditionalSalary::create(
                AdditionalSalaryType::constType(),
                Money::create(5),
                0
            )
        );

        $departmentMock = $this->createMock(Department::class);

        $this->departmentRepository
            ->expects($this->once())
            ->method('findById')
            ->with($departmentId)
            ->willReturn($departmentMock);

        $this->employeeRepository
            ->expects($this->once())
            ->method('save');

        $this->handler->handle($command);
    }

    public function testDepartmentNotExists(): void
    {
        $departmentId = Uuid::uuid4();
        $command = new CreateEmployeeCommand(
            Uuid::uuid4(),
            "Paweł",
            "Maj",
            $departmentId,
            Money::create(10),
            AdditionalSalary::create(
                AdditionalSalaryType::constType(),
                Money::create(5),
                0
            )
        );

        $this->departmentRepository
            ->expects($this->once())
            ->method('findById')
            ->with($departmentId)
            ->willReturn(null);

        $this->expectException(DepartmentNotFoundException::class);
        $this->handler->handle($command);
    }
}
