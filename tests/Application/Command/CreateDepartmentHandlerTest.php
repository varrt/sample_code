<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\CreateDepartmentCommand;
use App\Application\Command\CreateDepartmentHandler;
use App\Domain\Department\Repository\DepartmentRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateDepartmentHandlerTest extends TestCase
{
    private DepartmentRepositoryInterface $repository;

    private CreateDepartmentHandler $handler;

    public function setUp(): void
    {
        $this->repository = $this->createMock(DepartmentRepositoryInterface::class);
        $this->handler = new CreateDepartmentHandler($this->repository);
    }

    public function testCreateDepartment(): void
    {
        $command = new CreateDepartmentCommand(
            Uuid::uuid4(),
            "Test name"
        );

        $this->repository
            ->expects($this->once())
            ->method('save');

        $this->handler->handle($command);
    }
}
