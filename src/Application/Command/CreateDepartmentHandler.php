<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Department\Department;
use App\Domain\Department\Repository\DepartmentRepositoryInterface;

class CreateDepartmentHandler
{
    private DepartmentRepositoryInterface $repository;

    public function __construct(DepartmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateDepartmentCommand $command): void
    {
        $department = new Department($command->getId(), $command->getName());
        $this->repository->save($department);
    }
}
